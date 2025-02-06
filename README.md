# Warning  
This is a study project created with the purpose of learning about communication between microservices using Kafka. Therefore, no frameworks were used, and best programming practices were not applied, okay?  

## Project Structure  

The project consists of two microservices, which are:
* `./wallet-core`: a microservice written in GO that manages transactions and bank accounts, producing events/messages that are sent to Kafka;  
* `./balances`: a microservice written in PHP responsible for the balance of bank accounts, consuming messages from Kafka and updating its database;  

## Useful Commands  
```bash  
# To start all services, run:  
docker compose up -d  

# To view the logs of wallet-core:  
docker compose attach wallet-core  

# To view the logs of balances-consumer:  
docker compose attach balances-consumer  
```

## Testando via API
Use the `./api-testing.http` file in your preferred IDE to test the microservices' endpoints.
