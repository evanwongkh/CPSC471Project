<!DOCTYPE html>
<html>
<head>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
	<title>Login</title>
</head>
<style>

	*{

	}

	body{
		background-image: url("https://lh3.googleusercontent.com/pw/AMWts8AmLJwocTyHC92ggy1W1oZh7tn3vLqm_YYoz9KmhRxwyvex_zpwZlp6qKyfMGYY1Bbz2Ax8JPAbcN_962OxZ_Jg6AeobNtc-1DKwB5JyTcVnXJGVFiS9WK0dXZrfRNQY8LQlszKgNo-VYIL8PYIMPYo=w500-h359-s-no?authuser=0");
		background-repeat: no-repeat;
		background-size: cover;
		background-attachment: fixed;
		background-position: center;
		overflow: hidden;
		box-shadow: 0px 1px 8px rgba(0, 0, 0, 0.3);
		font-family: 'Quicksand', sans-serif;
		text-transform: uppercase;
		letter-spacing: 5px;
		position: relative;
		color: white;
	}

	span{
		color: #ffffff;
		display: flex;
		font-size: 100px;
		align-items: center;
		justify-content: center;
		padding-bottom: 50px;
		text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #fff, 0 0 40px #f800ff, 0 0 70px #f800ff, 0 0 80px #f800ff, 0 0 100px #f800ff, 0 0 150px #f800ff;
		animation: flicker 5s linear infinite;
	}

	header{
		color: black;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 30px;
		color: #000; 
		text-shadow: 0 0 5px #fff, 0 0 10px #fff, 0 0 15px #fff, 0 0 20px #aa04fb,0 0 30px #aa04fb, 0 0 40px #aa04fb;		
		font-weight: bold;
		letter-spacing: 2px;
	}

	.login{
		border: none;
		outline: none;
		border-radius: 30px;
		height: 50px;
		width: 110px;
		background: rgba(255, 255, 255, 0.7);
		font-size: 20px;
		cursor: pointer;
		transition: .2s;
	}

	.login:hover{
		letter-spacing: 1px;
		color: #fff;
		background: rgba(0, 0, 0, 0.7);
		border-radius: 50px;
	}

	.back{
		border: none;
		outline: none;
		border-radius: 30px;
		height: 50px;
		width: 200px;
		background: rgba(255, 255, 255, 0.7);
		font-size: 20px;
		cursor: pointer;
		margin-left: 2rem;
		margin-top: 2rem;
		transition: .2s;
	}

	.back:hover{
		letter-spacing: 1px;
		color: #fff;
		background: rgba(0, 0, 0, 0.7);
		border-radius: 50px;
	}

	.input{
		color: #fff;
		border: none;
		outline: none;
		font-size: 20px;
		padding-left: 50px;
		background: rgba(0, 0, 0, 0.3);
		height: 50px;
		width: 500px;
		border-radius: 30px;
		transition: 0.2s;
	}

	::-webkit-input-placeholder{
		color: #ffffff;
	}

	.input:hover{
		background: rgba(40, 40, 40, 0.5);
	}

	.input-field{
		display: flex;
		flex-direction: column;
		color: #fff;
		max-height: 100px;
		padding-bottom: 20px;
	}

	.container{
		display: flex;
		flex-direction: column;
		padding-left: 50px;
		padding-right: 50px;
		align-items: center;
		justify-content: center;
	}

	.page{
		padding-top: 10vh;
		display: flex;
		align-items: center;
		justify-content: center;
		min-height: 10vh;
		padding-bottom: 27vh;
	}

	.containerBottom{
		letter-spacing: 1px;
		font-size: 20px;
		align-items: center;
		justify-content: center;
	}

	.register{
		padding-left: 10px;
		color: #fff;
		text-decoration: none;
		text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #fff, 0 0 40px #f800ff, 0 0 70px #f800ff, 0 0 80px #f800ff, 0 0 100px #f800ff, 0 0 150px #f800ff;
		transition: 0.1s;
	}

	.register:hover{
		font-size: 21px;
		text-shadow: 0 0 150px #fff, 0 0 180px #fff, 0 0 220px #fff, 0 0 270px #f800ff, 0 0 330px #f800ff, 0 0 400px #f800ff, 0 0 480px #f800ff, 0 0 570px #f800ff;
	}

	@keyframes flicker {

	0%,
	18%,
	20%,
	22%,
	90.1%,
	92% {
		color: #ffffff;
		text-shadow: none;
		border: 5px black;
	}

	18.1%,
	20.1%,
	22.1%,
	90%,
	92.1%,
	100% {
		COLOR: #FFF;
		text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #fff, 0 0 40px #dd00ff, 0 0 70px #dd00ff, 0 0 80px #dd00ff, 0 0 100px #dd00ff, 0 0 150px #dd00ff;
	}
}

</style>
<body>
	<a href="index.php">
		<button class="back" >Return to Login</button>
	</a>
	<form action="register_process.php" method="POST">
	<div class='page'>
		<div class='container'>
			<div class="top-header">
				<span>Register!</span>
				<header>Put your info below</header>

			</div>

			<div class="input-field">
					<input type="text" name="username" class='input' placeholder='Username...' required>
			</div>

			<div class="input-field">
					<input type="password" name="password" class='input' placeholder='Password...' required>
			</div>

			<div class="input-field">
					<input type="text" name="fname" class='input' placeholder='First Name...' required>
			</div>

			<div class="input-field">
					<input type="text" name="lname" class='input' placeholder='Last Name...' required>
			</div>

			<div class="input-field">
					<input type="date" name="DOB" class='input' placeholder='Date of Birth (MM/DD/YY)' required>
			</div>

			<div class="input-field">
					<input type="submit" value="Register" class='login'>
			</div>

			

		</div>
	</div>
	</form>
</body>
</html>