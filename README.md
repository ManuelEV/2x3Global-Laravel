# Desafio 2x3 Global

Original repo: https://github.com/2x3-la/LaravelTest2x3Global

The purpose of this challenge is to demonstrate and follow the following points:

- Generate decent and maintainable PHP code
- Use the Laravel 5.x - 6.x framework
- Use the Laravel ORM (Eloquent) whenever possible
- Respect the definitions in models as proposed by the Framework
- Use of queues and events / listeners
- Write the code in ** English **
- Follow simple instructions

## Basic payment management (from clients)

#### Project instructions
The test project seeks to basically manage a database of clients, who have associated payments, that is, a client can have many payments, which in turn generate certain events in the system.

In technical terms, you must generate 3 endpoints, which must return the following structures (be careful with the arrangements and objects):

    GET /api/clients => [{                                        Listar clientes
		"id": 1,
		"email": "admin@example.com",
		"join_date": "Y-m-d",
	}]
	
	GET /api/payments?client={id} =>                          Listar pagos de un cliente
	[
		{
			"uuid": "4dc2aa90-744e-46da-aeea-952e211b719d",
			"payment_date": null,
			"expires_at": "2019-01-01"
			"status": "pending",
			"user_id": ?,
			"clp_usd": 810,
		},
		{
			"uuid": "4638609f-0b81-4d5d-a82a-456533e2d509",
			"payment_date": "2019-12-01",
			"expires_at": "2020-01-01"
			"status": "paid",
			"user_id": ?
			"clp_usd": 820,
		}
	]
	 
	POST /api/payments => {                                 Crear un pago en la plataforma
		"uuid": "1a59549c-0111-4411-86c3-8c3c0f9f0a99",
		"payment_date": null,
		"expires_at": "2020-02-26"
		"status": "pending",
		"user_id": ?,
		"clp_usd": null,
	}
	

As you can imagine, the models are made up of ** Client ** and ** Payment **, the structure of the models is in your hands, but they must contain the values ​​indicated in the example JSON and the corresponding relationships, you must ** use migrations ** to generate the database structure.

For the generation of clients, it is not necessary to have an endpoint, but the burden of that data remains in your hands.

### Specific instructions
- The database engine must be a relational DB (You can use MySQL, MariaDB, SQLite, etc. As long as it is relational)

- It is ** mandatory ** to use Laravel migrations to generate the database structure

- The columns or attributes of the models can be flexible (to your liking), however, they must contain ** if or if ** at least the structure of the ** JSON ** represented above.

- The Uuid to generate can be generated directly from Laravel, without installing an external package (https://laravel.com/docs/master/helpers#method-str-uuid)

- ** No ** it is necessary to upload the project on a web server, just send us the repository to review it.

### Business logic

- When creating a new payment, you must launch a background process using ** Jobs ** from Laravel, in which you consult the following API https://mindicador.cl/api/dolar and store the value of the day in which it is I generate in the payment that was created, the driver of ** queues ** is in your decision.

- A specific detail of the Job, is that if at the time of executing the Job, it is verified that a payment was already made that same day, that is, the endpoint was already used and the Job was previously executed (regardless of whether it is the same client), the dollar value of such record (coinciding with the day) must be reused, in order to avoid a new query to the dollar API, since this value was previously captured in a payment.

- When creating a new payment, you must trigger the use of ** Events and Listeners ** the sending of a notification email (it does not have to contain absolutely anything important, just send it), the use of ** Mailtrap ** for testing, you can apply the sending of the Job within a Listener if it suits you.


### How to deliver
- Simply, generate a new Laravel project, and send us the repository link, you can use any Git cloud service.