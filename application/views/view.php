<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $page_title ?></title>
		<style>
			body, html {
				font-family: monospace;
			}
		</style>
	</head>
	<body>
		<?php if($page == "invalid_key") { ?>
			<p>No Masterkey Provided, Or Invalid Masterkey Provided.</p>
		<?php } ?>
		<?php if($page == "updated_rates") { ?>
			<p>Rates have been updated.</p>
		<?php } ?>
		<?php if($page == "home") { ?>
			<p>Welcome to the Website, This is an actual Payment Gateway Service (Technically, For the Most Part)</p>
			<a href="<?php echo $url ?>user">Go To Login</a> <a href="<?php echo $url ?>user/register">Go To Register</a>
		<?php } ?>
		<?php if($page == "logged_in") { ?>
			<p>Currently Logged in As: <?php echo $user["username"] ?><br><br>
Your Balance is: <span style="text-decoration: underline;"><?php echo $user["balance_held_in_currency"] ?></span> <span style="text-transform: uppercase"><?php echo $user["currency"] ?></span><br><br>
You can receive money through the following ways:-<br>
	-> Someone sends you Money to your E-Mail Address: <?php echo $user["email"] ?><br>
	-> You can receive money anonymously by your Unique Address: <?php echo $user["unique_address"] ?><br><br>
<a href="<?php echo $url ?>user/send">Send Money</a> <a href="<?php echo $url ?>user/logout">Logout</a><br><br>
Address Info:-<br><br>
Address Line 1: <?php echo $user["address"]["line_1"] ?><br>
Address Line 2: <?php echo $user["address"]["line_2"] ?><br>
City: <?php echo $user["address"]["city"] ?><br>
Zip Code: <?php echo $user["address"]["zipcode"] ?><br>
State: <?php echo $user["address"]["state"] ?><br>
Country: <?php echo $user["address"]["country"] ?><br><br>
<a href="<?php echo $url ?>user/change_address">Change Address</a><br><br>
Recent Transactions:-<br><br>
<?php if(isset($user["recent_transactions"])) { foreach($user["recent_transactions"] as $key => $transaction) { ?>
-> Sent <span style="text-decoration:underline;"><?php echo $transaction["amount_in_currency"] ?></span> <?php echo $user["currency"] ?> To <strong><?php echo $transaction["sent_to"] ?></strong> on <?php echo $transaction["date"] ?><br>
<?php } ?><br><a href="<?php echo $url ?>user/transactions">View All Transactions</a> <?php } else { ?>
No Transactions to Show.
<?php } ?><br><br>
API Access :-<br><br>
<?php if(isset($user["merchant_info"])) { ?>
API Access Key: <?php echo $user["access_key"] ?> <a href="<?php echo $url ?>user/new_key">Generate a New Key</a><br><br>
<a href="<?php echo $url ?>api">API Reference</a><br><br>
Merchant Name: <?php echo $user["merchant_info"]["name"] ?><br>
Merchant Description: <?php echo $user["merchant_info"]["description"] ?><br><br>
<a href="<?php echo $url ?>user/change_merchant_info">Change Merchant Info</a>
<?php } else { ?>
You need to have a Merchant Account for API Access<br><br>
<a href="<?php echo $url ?>user/upgrade">Upgrade to Merchant Account (Cannot be Undone)</a><br><br>
<?php } ?>
			</p>
			</a>
		<?php } ?>
		<?php if($page == "login") { ?>
				<?php echo $error_msg ?>
				<form method="post" action="<?php echo $url ?>user">
					<input type="email" name="email" id="email" placeholder="Enter your E-Mail" />
					<br>
					<input type="password" name="password" id="password" placeholder="Enter your Password" />
					<input type="hidden" name="login-submission" value="true" />
					<br>
					<input type="submit" value="Login" />
				</form>
						
		<?php } ?>
	</body>
</html>