<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "movietheatre";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <title>Admin Panel</title>
</head>

<style>

	html {
		margin: 0;
		padding: 0;
	}

    :root{
        font-family: 'Quicksand', sans-serif;
        font-size: 20px;
    }

    body{
        color: white;
		margin: 0;
		padding: 0;
		width: 100vw;
    	height: 100vh;
    	background-image: linear-gradient(135deg, rgba(20, 20, 20, 1) 0%, rgba(40, 40, 40, 1) 40%, rgba(20, 20, 20, 1) 80%);
        background-repeat: repeat-y;
        background-attachment: fixed;
        background-size: cover;
		overflow-x: hidden;
    }

	body::-webkit-scrollbar{
		width: 1rem;
	}

	body::-webkit-scrollbar-thumb{
		background: #911fff;
	}

	body::-webkit-scrollbar-track{
		background: #fffbff;
	}

    .unique{
		margin-left: 6rem;
		padding-top: 0.1vh;
		text-decoration: none;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

	.menu{
		width: 5rem;
		height: 100vh;
		position: fixed;
		background-color: #1e003f;
		transition: 0.2s ease;
		z-index: 1;
	}

	.menuBar{
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		padding: 0;
		margin: 0;
		height: 100%;
		list-style: none;
	}

	.menuButton{
		width: 100%;
	}

	.menuButton:last-child{
		margin-top: auto;
	}

	.menuText{
		display: flex;
		align-items: center;
		height: 4.5rem;
		color: #fff;
		text-decoration: none;
		transition: 0.2s;
		width: 100%;
	}

	.menuText2{
		display: flex;
		align-items: center;
		height: 6rem;
		justify-content: center;
		color: #fff;
		text-decoration: none;
		transition: 0.3s;
		
	}

	.menuText2:hover{
		background: #df93ff;
		color: white;
		text-shadow: 0 0 10px #5b0e91;
		box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
		width: 100%;
	}

	.menuText:hover{
		background: #b8b6b9;
		color: black;
		width: 100%;
		box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
	}

	.menuLinkText{
		display: none;
		margin-left: 0.5rem;
	}

	.menuText svg{
		min-width: 2.9rem;
		min-height: 2.9rem;
		margin-left: 1rem;
	}

	.menu:hover{
		width: 14rem;
	}

	.menu:hover .menuLinkText{
		display: block;
	}

	path {
		fill: #911fff;
	}

	.title{
		font-weight: bold;
		margin-bottom: 1rem;
		text-align: center;
		justify-content: center;
		background: #15002c;
		color: black;
		font-size: 50px;
		letter-spacing: 10px;
		width: 100%;
	}

    #addMovie{
        border: 1px solid white;
        padding: 5vh;
    }

    h3{
        font-size: 20px;
    }
    
    h4{
        font-size: 30px;
        color: #911fff;
    }

    .login{
		border: none;
		outline: none;
		border-radius: 30px;
		height: 50px;
		width: 150px;
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


</style>

<body>

<div class="cursorGlow"></div>
	<nav class="menu">
		<ul class ="menuBar">
			<li class="title">
				<a href="dashboard.php" class="menuText2">
				<span class="menuLinkText">REEL</span>
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="150pt" height="150pt" version="1.1" viewBox="0 0 700 550">
					<path xmlns="http://www.w3.org/2000/svg" d="m474.04 274.4-120.12-108.86c-2.2695-2.0117-5.6836-2.0117-7.9531 0l-120.01 108.86c-2.2656 1.4297-3.2031 4.2656-2.2344 6.7617 0.96875 2.5 3.5742 3.9609 6.2109 3.4883h22.398v106.4c0.03125 3.2578 2.6797 5.8828 5.9375 5.8828h51.91c1.5352 0 3.0039-0.62891 4.0625-1.7383 1.0586-1.1133 1.6133-2.6094 1.5391-4.1445v-67.758c-0.019531-1.6289 0.64062-3.1953 1.8164-4.3203 1.1797-1.125 2.7734-1.7109 4.3984-1.6172h56.281c1.5664 0 3.0703 0.62891 4.1758 1.7422s1.7188 2.625 1.7031 4.1953v67.703c-0.078125 1.5312 0.48047 3.0312 1.5391 4.1406 1.0586 1.1133 2.5273 1.7422 4.0625 1.7383h52.078c1.5352 0.003906 3.0039-0.625 4.0625-1.7383 1.0586-1.1094 1.6133-2.6094 1.5391-4.1406v-106.4h22.398c2.6484 0.57031 5.3281-0.83594 6.3633-3.3398 1.0312-2.5078 0.12109-5.3945-2.1641-6.8555z"/>

				</svg>
				</a>

			</li>
			<li class="menuButton">
				<a href="mytickets.php" class="menuText">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32pt" height="32pt" version="1.1" viewBox="0 0 700 550">
					<path xmlns="http://www.w3.org/2000/svg" d="m618.62 142.62v-22.75h-537.25v22.75c8.75 0 15.75 7.875 15.75 16.625s-7 16.625-15.75 16.625v27.125c8.75 0 15.75 7.875 15.75 16.625s-7 16.625-15.75 16.625v27.125c8.75 0 15.75 7.875 15.75 16.625s-7 16.625-15.75 16.625v27.125c8.75 0 15.75 7.875 15.75 16.625s-7 16.625-15.75 16.625v27.125c8.75 0 15.75 7.875 15.75 16.625s-7 16.625-15.75 16.625v22.75h536.38v-22.75c-8.75 0-15.75-7.875-15.75-16.625s7-16.625 15.75-16.625v-27.125c-8.75 0-15.75-7.875-15.75-16.625s7-16.625 15.75-16.625v-27.125c-8.75 0-15.75-7.875-15.75-16.625s7-16.625 15.75-16.625v-27.125c-8.75 0-15.75-7.875-15.75-16.625s7-16.625 15.75-16.625v-27.125c-8.75 0-15.75-7.875-15.75-16.625s7-15.75 16.625-16.625zm-76.125 232.75c0 16.625-14 30.625-30.625 30.625h-323.75c-16.625 0-30.625-14-30.625-30.625v-190.75c0-16.625 14-30.625 30.625-30.625h323.75c16.625 0 30.625 14 30.625 30.625z"/>
					<path xmlns="http://www.w3.org/2000/svg" d="m511.88 172.38h-323.75c-7 0-12.25 5.25-12.25 12.25v189.88c0 7 5.25 12.25 12.25 12.25h323.75c7 0 12.25-5.25 12.25-12.25v-189.88c0-6.125-5.25-12.25-12.25-12.25z"/>
				</svg>
					<span class="menuLinkText">Tickets</span>
				
				</a>
			</li>
			<li class="menuButton">
				<a href="food.php" class="menuText">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32pt" height="32pt" version="1.1" viewBox="0 0 700 550">
					<path xmlns="http://www.w3.org/2000/svg" d="m579.18 156.28-93.43 101.39c-0.11719 0.11719-0.24609 0.23047-0.375 0.34766-15.602 15.371-35.918 23.051-56.246 23.051-12.125 0-24.258-2.7344-35.387-8.2031l-80.078 80.078 5.8906 5.8906-144.52 144.52c-5.8477 5.8477-13.281 9.1328-20.922 9.8672-1.0938 0.10547-2.1914 0.15625-3.293 0.15625-0.54297 0-1.0938-0.011718-1.6367-0.039062-3.2812-0.15625-6.5469-0.78516-9.6836-1.8828-0.51953-0.17969-1.043-0.37891-1.5586-0.58984-4.1172-1.6758-7.9805-4.1758-11.324-7.5195s-5.8477-7.2031-7.5195-11.324c-0.20703-0.50781-0.41016-1.0312-0.58984-1.5586-1.0977-3.1367-1.7266-6.3945-1.8828-9.6836-0.078125-1.6406-0.039063-3.2891 0.11719-4.9219 0.72656-7.6328 4.0195-15.07 9.8672-20.922l144.51-144.51 5.8906 5.8906 80.078-80.078c-14.711-29.949-9.6367-67.16 15.27-92.074l0.035156 0.035156 101.35-93.367c3.125-3.125 6.6289-4.2227 9.6602-4.2227 2.9961 0 5.5312 1.0703 6.7773 2.3125l-106.51 106.51 0.011719 0.011719 106.5-106.5c2.4961 2.4961 4.3008 10.227-1.9023 16.438l-93.371 101.31 22.941 22.941 101.32-93.367c3.125-3.125 6.6289-4.2227 9.6602-4.2188 2.9961 0 5.5312 1.0703 6.7773 2.3125l-106.5 106.51 0.011719 0.011718 106.51-106.51c2.4961 2.4961 4.3008 10.227-1.9023 16.438l-93.375 101.32 22.977 22.977 101.32-93.363c3.125-3.125 6.6289-4.2227 9.6602-4.2188 2.9961 0 5.5312 1.0703 6.7773 2.3125l-106.51 106.51 0.011719 0.011719 106.51-106.51c2.4961 2.4922 4.3047 10.223-1.9062 16.43zm-163.96 154.17-5.8984 5.8984-16.277-16.277-36.617 36.617 16.273 16.273-5.8906 5.8906 144.51 144.51c13.367 13.367 35.039 13.363 48.406 0 13.367-13.367 13.363-35.039 0-48.406zm-138.44-20.371 53.145-53.145-16.289-16.289-104.12-104.11c-10.668-10.668-41.137-33.93-54.168-22.16-0.003906 0.003906-0.015624 0.015625-0.015624 0.015625-22.77 22.832 8.125 90.68 69.02 151.57 17.309 17.316 35.184 32.195 52.426 44.113z"/>
				</svg>
					<span class="menuLinkText"> Food</span>
				</a>
			</li>

			<li class="menuButton">
				<a href="promotion.php" class="menuText">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32pt" height="32pt" version="1.1" viewBox="0 0 700 400">
				<path xmlns="http://www.w3.org/2000/svg" d="m138.27 211.73c0-116.6 95.125-211.73 211.73-211.73s211.73 95.125 211.73 211.73c0 116.6-95.125 211.73-211.73 211.73s-211.73-95.125-211.73-211.73zm239.34-27.617h67.508c6.1367 0 9.207 7.6719 4.6016 10.738l-56.766 39.891 21.48 65.973c3.0703 6.1367-4.6016 10.738-9.207 6.1367l-55.234-39.891-55.234 39.891c-4.6016 4.6016-12.273 0-10.738-6.1367l21.48-65.973-55.234-39.891c-4.6016-3.0703-1.5352-10.738 4.6016-10.738h67.508l21.48-65.973c1.5352-6.1367 10.738-6.1367 12.273 0z" fill-rule="evenodd"/>
				</svg>
					<span class="menuLinkText"> Promotions</span>
				</a>
			</li>

			<li class="menuButton">
				<a href="discount.php" class="menuText">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32pt" height="32pt" version="1.1" viewBox="0 0 700 550">
				<path xmlns="http://www.w3.org/2000/svg" d="m334.3 42.059c3.9883-4.4922 9.707-7.0586 15.703-7.0586s11.715 2.5664 15.703 7.0586c0 0 29.18 32.887 29.18 32.887 4.8281 5.4375 11.012 9.4961 17.93 11.738 6.918 2.25 14.305 2.6133 21.41 1.0508 0 0 42.934-9.4609 42.934-9.4609 5.8672-1.2852 11.992-0.011719 16.844 3.5234 4.8672 3.5195 7.9688 8.957 8.5664 14.93 0 0 4.2695 43.762 4.2695 43.762 0.71094 7.2344 3.3359 14.152 7.6055 20.035 4.2695 5.8906 10.047 10.523 16.707 13.426l40.297 17.594c5.4961 2.4023 9.707 7.0352 11.562 12.754 1.8555 5.7031 1.1758 11.934-1.8555 17.102 0 0-22.273 37.918-22.273 37.918-3.6758 6.2734-5.6211 13.414-5.6211 20.684s1.9453 14.41 5.6211 20.684c0 0 22.273 37.918 22.273 37.918 3.0312 5.168 3.7109 11.398 1.8555 17.102-1.8555 5.7188-6.0664 10.352-11.562 12.754l-40.297 17.594c-6.6602 2.9023-12.438 7.5352-16.707 13.426-4.2695 5.8828-6.8945 12.801-7.6055 20.035 0 0-4.2695 43.762-4.2695 43.762-0.59766 5.9727-3.6992 11.41-8.5664 14.93-4.8516 3.5352-10.977 4.8086-16.844 3.5234 0 0-42.934-9.4609-42.934-9.4609-7.1055-1.5625-14.492-1.1992-21.41 1.0508-6.918 2.2422-13.102 6.3008-17.93 11.738 0 0-29.18 32.887-29.18 32.887-3.9883 4.4922-9.707 7.0586-15.703 7.0586s-11.715-2.5664-15.703-7.0586c0 0-29.18-32.887-29.18-32.887-4.8281-5.4375-11.012-9.4961-17.93-11.738-6.918-2.25-14.305-2.6133-21.41-1.0508 0 0-42.934 9.4609-42.934 9.4609-5.8672 1.2852-11.992 0.011719-16.844-3.5234-4.8672-3.5195-7.9688-8.957-8.5664-14.93 0 0-4.2695-43.762-4.2695-43.762-0.71094-7.2344-3.3359-14.152-7.6055-20.035-4.2695-5.8906-10.047-10.523-16.707-13.426l-40.297-17.594c-5.4961-2.4023-9.707-7.0352-11.562-12.754-1.8555-5.7031-1.1758-11.934 1.8555-17.102 0 0 22.273-37.918 22.273-37.918 3.6758-6.2734 5.6211-13.414 5.6211-20.684s-1.9453-14.41-5.6211-20.684c0 0-22.273-37.918-22.273-37.918-3.0312-5.168-3.7109-11.398-1.8555-17.102 1.8555-5.7188 6.0664-10.352 11.562-12.754l40.297-17.594c6.6602-2.9023 12.438-7.5352 16.707-13.426 4.2695-5.8828 6.8945-12.801 7.6055-20.035 0 0 4.2695-43.762 4.2695-43.762 0.59766-5.9727 3.6992-11.41 8.5664-14.93 4.8516-3.5352 10.977-4.8086 16.844-3.5234 0 0 42.934 9.4609 42.934 9.4609 7.1055 1.5625 14.492 1.1992 21.41-1.0508 6.918-2.2422 13.102-6.3008 17.93-11.738 0 0 29.18-32.887 29.18-32.887zm85.703 249.61c-32.199 0-58.332 26.133-58.332 58.332s26.133 58.332 58.332 58.332 58.332-26.133 58.332-58.332-26.133-58.332-58.332-58.332zm-178.42 113.25 233.33-233.33c4.5508-4.5508 4.5508-11.945 0-16.496-4.5508-4.5508-11.945-4.5508-16.496 0l-233.33 233.33c-4.5508 4.5508-4.5508 11.945 0 16.496 4.5508 4.5508 11.945 4.5508 16.496 0zm178.42-89.914c19.32 0 35 15.68 35 35s-15.68 35-35 35-35-15.68-35-35 15.68-35 35-35zm-140-163.33c-32.199 0-58.332 26.133-58.332 58.332s26.133 58.332 58.332 58.332 58.332-26.133 58.332-58.332-26.133-58.332-58.332-58.332zm0 23.332c19.32 0 35 15.68 35 35s-15.68 35-35 35-35-15.68-35-35 15.68-35 35-35z" fill-rule="evenodd"/>
				</svg>
					<span class="menuLinkText"> Discounts</span>
				</a>
			</li>

			<li class="menuButton">
				<a href="admin.php" class="menuText">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32pt" height="32pt" version="1.1" viewBox="0 0 700 550">
				<path xmlns="http://www.w3.org/2000/svg" d="m557.86 228.79v102.42h-52.203c-2.6133 7.8398-5.7227 15.367-9.3945 22.648l36.898 36.961-72.363 72.363-36.961-36.961c-7.2812 3.6719-14.809 6.8438-22.648 9.3945v52.266h-102.36v-52.266c-7.8398-2.5508-15.43-5.7227-22.648-9.3945l-36.961 36.961-72.363-72.363 36.898-36.961c-3.6719-7.2812-6.7812-14.809-9.3945-22.648h-52.203v-102.42h52.203c2.6133-7.7773 5.7227-15.367 9.3945-22.648l-36.898-36.898 72.363-72.426 36.961 36.961c7.2188-3.6719 14.809-6.8438 22.648-9.3945v-52.266h102.36v52.266c7.8398 2.5508 15.367 5.7227 22.648 9.3945l36.961-36.961 72.363 72.426-36.898 36.898c3.6719 7.2812 6.7812 14.871 9.3945 22.648zm-130.04 51.207c0-42.934-34.844-77.777-77.84-77.777-42.934 0-77.777 34.844-77.777 77.777 0 42.996 34.844 77.777 77.777 77.777 42.996 0 77.84-34.781 77.84-77.777z"/>
				</svg>
					<span class="menuLinkText"> Admin</span>
				</a>
			</li>

			<li class="menuButton">
				<a href="logout.php" class="menuText">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32pt" height="32pt" version="1.1" viewBox="0 0 700 550">
					<path xmlns="http://www.w3.org/2000/svg" d="m490 140c0 77.32-62.68 140-140 140s-140-62.68-140-140 62.68-140 140-140 140 62.68 140 140"/>
					<path xmlns="http://www.w3.org/2000/svg" d="m451.85 281.93c-29.652 21.477-65.328 33.039-101.94 33.039-36.613 0-72.289-11.562-101.94-33.039-52.422 20.512-97.445 56.344-129.19 102.83-31.75 46.484-48.75 101.46-48.785 157.75 0 4.6406 1.8438 9.0938 5.125 12.375s7.7344 5.125 12.375 5.125h525c4.6406 0 9.0938-1.8438 12.375-5.125s5.125-7.7344 5.125-12.375c-0.050781-56.312-17.074-111.3-48.855-157.79-31.781-46.484-76.84-82.309-129.29-102.79z"/>
				</svg>
					<span class="menuLinkText">Logout</span>
				
				</a>
			</li>
		</ul>
	</nav>

    <div class="unique">

    <?php
        $AccID = $_SESSION['AccID'];

        // Check if user is an admin
        $sql = "SELECT * FROM user WHERE AccID='$AccID' AND admin=1";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 0) {
            $error_message = "You do not have the necessary permissions to access this page.";
            header("Location: dashboard.php?error_message=".urlencode($error_message));
            exit();
        }

        // Add movie to database
        if (isset($_POST['submit_movie'])) {
            $movie_title = $_POST['movie_title'];

            $sql = "INSERT INTO movie (Title) VALUES ('$movie_title')";

            if (mysqli_query($conn, $sql)) {
                $message = "Movie added successfully.";
            } else {
                $error = "Error adding movie: " . mysqli_error($conn);
            }
        }

        // Add theatre to database
        if (isset($_POST['submit_theatre'])) {
            $MovieID = $_POST['MovieID'];

            $sql = "INSERT INTO theatre (MovieID) VALUES ('$MovieID')";

            if (mysqli_query($conn, $sql)) {
                $message = "Theatre added successfully.";
            } else {
                $error = "Error adding theatre: " . mysqli_error($conn);
            }
        }

        // Add showtime to database
        if (isset($_POST['add_showtime'])) {    
            $theatreNo = mysqli_real_escape_string($conn, $_POST['theatreNo']);
            $time = mysqli_real_escape_string($conn, $_POST['time']);
            $convertedTime = date('h:i A', strtotime($time));
            // Insert the showtime into the database
            $sql = "INSERT INTO showtimes (theatreNo, time) VALUES ('$theatreNo', '$convertedTime')";
            if (mysqli_query($conn, $sql)) {
                echo "<p>Showtime added successfully.</p>";
            } else {
                echo "<p>Error adding showtime: " . mysqli_error($conn) . "</p>";
            }
        }

        // Delete movie from database
        if (isset($_POST['delete_movie'])) {
            $MovieID = $_POST['MovieID'];
            $sql = "DELETE FROM movie WHERE MovieID=$MovieID";
            mysqli_query($conn, $sql);
        }

        // Delete theatre from database
        if (isset($_POST['delete_theatre'])) {
            $theatreNo = $_POST['theatreNo'];
            $sql = "DELETE FROM theatre WHERE theatreNo=$theatreNo";
            mysqli_query($conn, $sql);
        }

        // Delete showtime from database
        if (isset($_POST['delete_showtime'])) {
            $showtimeNo = $_POST['showtimeNo'];
            $sql = "DELETE FROM showtimes WHERE showtimeNo=$showtimeNo";
            mysqli_query($conn, $sql);
        }

        // Retrieve movies from database
        $sql = "SELECT * FROM movie";
        $movie_result = mysqli_query($conn, $sql);

        // Retrieve theatres from database
        $sql = "SELECT * FROM theatre";
        $theatre_result = mysqli_query($conn, $sql);

        $sql = "SELECT * FROM showtimes";
        $showtime_result = mysqli_query($conn, $sql);

        mysqli_close($conn);
    ?>
    
	<div class="regText">
		<h3>Welcome, <?php echo $_SESSION['username']; ?> to the Admin Panel<h3>
    <?php if (isset($message)) echo "<p style='color:green'>$message</p>" ?>
    <?php if (isset($error)) echo "<p style='color:red'>$error</p>" ?>
    <div id="addMovie">
    <h4>Add Movie</h4>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="movie_title">Movie Name:</label>
        <input type="text" name="movie_title" id="movie_title" required>
        <br>
        <!-- <label for="movie_description">Description:</label>
        <textarea name="movie_description" id="movie_description" required></textarea>
        <br> -->
        <input class='login' type="submit" name="submit_movie" value="Add Movie">
    </form>
    </div>
    <div id="addMovie">
    <h4>Enter the movie ID that the new theatre is showing</h4>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="MovieID">Movie ID:</label>
        <input type="text" name="MovieID" id="MovieID" required>
        <br>
        <!-- <label for="theatre_location">Location:</label>
        <input type="text" name="theatre_location" id="theatre_location" required>
        <br> -->
        <input class='login' type="submit" name="submit_theatre" value="Add Theatre">
    </form>
    </div>
    <div id="addMovie">
    <h4>Add Showtime</h4>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="theatreNo">Theatre Number:</label>
        <input type="text" name="theatreNo" required>
        <br><br>
        <label for="time">Time:</label>
        <input type="time" name="time" required>
        <br><br>
        <input class='login' type="submit" name="add_showtime" value="Add Showtime">
    </form>
    </div>
    <div id="addMovie">
    <h4>Movies</h4>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($movie_result)) : ?>
                <tr>
                    <td><?php echo $row['MovieID']; ?></td>
                    <td><?php echo $row['Title']; ?></td>
                    <td>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="hidden" name="MovieID" value="<?php echo $row['MovieID']; ?>">
                            <input class='login' type="submit" name="delete_movie" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    </div>
    <div id="addMovie">
    <h4>Theatres</h4>
    <table>
        <thead>
            <tr>
                <th>Theatre Number</th>
                <th>Movie ID</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($theatre_result)) : ?>
                <tr>
                    <td><?php echo $row['theatreNo']; ?></td>
                    <td><?php echo $row['MovieID']; ?></td>
                    <td>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="hidden" name="theatreNo" value="<?php echo $row['theatreNo']; ?>">
                            <input class='login' type = "submit" name = "delete_theatre" value = "Delete">
                            </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    </div>
    <div id="addMovie">
    <h4>Showtimes</h4>
    <table>
        <thead>
            <tr>
                <th>Showtime Number</th>
                <th>Theatre Number</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($showtime_result)) : ?>
                <tr>
                    <td><?php echo $row['showtimeNo']; ?></td>
                    <td><?php echo $row['theatreNo']; ?></td>
                    <td>
                        <?php 
                            $time = date("h:i A", strtotime($row['time'])); 
                            echo $time;
                        ?>
                    </td>
                    <td>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="hidden" name="showtimeNo" value="<?php echo $row['showtimeNo']; ?>">
                            <input class='login' type="submit" name="delete_showtime" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
	</div>
    </div>
</div>

</body>

</html>