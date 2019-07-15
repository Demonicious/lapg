# Literally a Payment Gateway
 Believe it or not, This is the Code of a Payment Gateway Service (Technically, For the Most Part)

### Account Preview (What You See after Logging In)
![What you See After Logging In](/image.png?raw=true "What you see after Logging In")

As you can see, I definitely didn't pay attention to design, at all.
But that shouldn't stop you from slapping a beautiful template on this.

### Details
Written in CodeIgniter 3.1.10 with more of a... Model Controller Approach rather than a Model View Controller Approach cause there's only 1 view, where everything happens and I didn't wanna bother creating good looking templates. And I couldn't find any Free ones online either. The code (at this point in time) is not the cleanest you'd find. Right now im just making things "work" and then i'll optimize it afterwards. But Anyways Moving on..

### Setting up the Database
Theres a file called "lapg_db.sql" in the Repo. Import that into your Database and after doing so, Edit application/config/database.php with the Correct Database Credentials.

### Setting Up the Fixer.io API
Get an API Key from Fixer.io (its Free) and edit application/models/utilitymodel.php. Set $apikey = *Your Api Key* in the update() method.
Call the Update() Method once (to fill the Database with Latest Currency Conversion rates) otherwise it won't work.
The base currency is EUR, and every other currency shows up after being converted. There is a Method to Convert Currency from EUR to Any Currency, and then another Method to convert any currency to EUR. Pretty Cool.

### Current Progress
1.) Login Implemented<br />
2.) Merchant Status Upgrade<br />
3.) Changing of Username, Address, Password, Merchant Info (E-Mail will be done later)
5.) Generating New API Keys<br />
6.) Sending and Receiving Payments with your Unique Address

### Whats about to come ?
1.) Registration<br/>
2.) A REST API for Dynamically Generating Invoices and Ability to check if an invoice has been paid or not.<br/>
3.) A Checkout Page with a Login Form and Confirmation Button for use with the Payments API.
4.) Changing of Email<br/>
5.) Sending and Receiving Payments Through the Email<br/>
6.) Write an API Documentation (Will barely be 2 Pages, at max)<br/>

Well, Theres a lot to do. And this is just a Fun little Project I do in my free time. But I wanna finish this, Soon hopefully.
