<?php declare(strict_types=1);

use RdKafka\Message;

$conf = new RdKafka\Conf();
$conf->set('group.id', 'wallet');
$conf->set('metadata.broker.list', 'kafka:29092');

$consumer = new RdKafka\KafkaConsumer($conf);
$consumer->subscribe(['balances']);

echo "Waiting messages on balances...\n";

while (true) {
    $message = $consumer->consume(120 * 1000);

    switch ($message->err) {
        case RD_KAFKA_RESP_ERR_NO_ERROR:
            echo "RECEIVED MESSAGE: " . $message->payload . "\n";
            updateAccounts($message);
            break;
        case RD_KAFKA_RESP_ERR__PARTITION_EOF:
            echo "End of partition, waiting...\n";
            break;
        case RD_KAFKA_RESP_ERR__TIMED_OUT:
            echo "Timeout, waiting...\n";
            break;
        default:
            throw new \Exception($message->errstr(), $message->err);
    }
}

function updateAccounts(Message $message): void
{
    $payload = json_decode($message->payload, true)['Payload'];

    $connection = new mysqli('balances-db', 'root', 'root', 'balances');
    if ($connection->connect_error) die("Error: " . $connection->connect_error);

    $sqlFrom = "UPDATE accounts SET balance = {$payload['balance_account_id_from']} WHERE id = '{$payload['account_id_from']}';";
    $sqlTo = "UPDATE accounts SET balance = {$payload['balance_account_id_to']} WHERE id = '{$payload['account_id_to']}';";
    $connection->query($sqlFrom);
    $connection->query($sqlTo);

    $connection->close();
}
