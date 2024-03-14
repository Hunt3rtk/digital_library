<header>
    <div class="profile_pic_container">
        <div class="profile_pic_frame">
            <!-- <img src="img/" alt="USERNAME"> -->
        </div>
    </div>
    <div class="profile_info_col1">
        <h1><?php echo $user['username']?></h1>
        <p><?php echo $user['email']?></p><br>
    </div>
    <div class="profile_info_col2">
    </div>
    <div class="col4">
        <a href="?action=logout"><button>LOG OUT</button></a>
    </div>
</header>