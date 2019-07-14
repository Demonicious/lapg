# Literally a Payment Gateway
 Believe it or not, This is the Code of a Payment Gateway Service (Technically, For the Most Part)

### Account Preview (What You See after Logging In)
![What you See After Logging In](/image.png?raw=true "What you see after Logging In")

As you can see, I definitely didn't pay attention to design, at all.
But that shouldn't stop you from slapping a beautiful template on this.

### Details
Written in CodeIgniter 3.1.10 with more of a... Model Controller Approach rather than a Model View Controller Approach cause there's only 1 view, where everything happens and I didn't wanna bother creating good looking templates. And I couldn't find any Free ones online either. But Anyways Moving on..

### Setting up the Database
Theres a file called "lapg_db.sql" in the Repo. Import that into your Database and after doing so, Edit application/config/database.php with the Correct Database Credentials.

### Setting Up the Fixed.io API
Get an API Key from Fixer.io (its Free) and edit application/models/utilitymodel.php. Set $apikey = *Your Api Key* in the update() method.

### Current Progress
Currently, I've only Implemented Data Retrieval from Database (CRUD lul)

### Whats about to come ?
1.) Login/Registration<br/>
2.) Merchant Account Upgrades<br/>
3.) A REST API for Dynamically Generating Invoices and Ability to check if an invoice has been paid or not.<br/>
4.) Changing of Username, Email, Password, Address.<br/>
5.) Generating New API Keys<br/>
6.) Sending and Receiving Payments Through the 2 Methods as seen in the Image above (along with the API Invoices)<br/>
7.) Write an API Documentation (Will barely be 2 Pages, at max)<br/>

Well, Theres a lot to do. And this is just a Fun little Project I do in my free time. But I wanna finish this, Soon hopefully.
