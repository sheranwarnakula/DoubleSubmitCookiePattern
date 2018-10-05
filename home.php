<?php
	
	if(isset($_POST['username'],$_POST['password'])){
		$uname = $_POST['username'];
		$pwd = $_POST['password'];
		
		if($uname == 'admin' && $pwd == 'admin'){
			echo "<h2>";
			echo 'You have Successfully logged in!';
			echo "</br></br>";
			echo "</h2>";
			
			session_start();
			$_SESSION['csfr_token'] = base64_encode(openssl_random_pseudo_bytes(32));
			$session_id = session_id();
			setcookie('session_Cookie',$session_id,time()+60*60*24*365,'/');
			setcookie('csrf_Cookie',$_SESSION['csfr_token'],time()+60*60*24*365,'/');
		}	
			
		else{
			echo "<h2>";
			echo 'Invalid Credentials! Try Again!';
			echo "</h2>";
			exit();
		}		
	}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Transfer Money</title>
        <link rel="stylesheet" type="text/css" href="all_styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
		<script>		    
            $(document).ready(function(){	
            	var name = "csrf_Cookie" + "=";
                var cookie_value = "";
                var decodedCookie = decodeURIComponent(document.cookie);
                var ca = decodedCookie.split(';');

                for(var i = 0; i <ca.length; i++) {
                    var c = ca[i];
                    
                    while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                       cookie_value = c.substring(name.length, c.length);
                       document.getElementById("token_to_be_added").setAttribute('value', cookie_value) ;
                    }
                }	
            });
                    
               
        </script>        
    </head>
   
    <body>
        <form action="transfer_money.php" method="post" id="form_login">          
            <br/><h1>Enter the Information to Transfer Money</h1>
            <br/><br/>
                    Account Number: <input type="password" name="accountNo"><br/><br/>
					Amount:         <input type="text" name="amount"><br/><br/>
            <br/>
            <input type="Submit" value="Transfer Money">
            <div id="div1">
                <input type="hidden" name="csrf_token" value="" id="token_to_be_added"/>
            </div>           
        </form>
    </body> 
</html>
