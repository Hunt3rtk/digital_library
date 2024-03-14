<nav>
    <ul>
        <a href=<?php echo "?action=discover_list&user_id=".$user_id?>>
        <li <?php if ($action == 'discover_list') { echo "class='selected'";}?>>
           <img src="../public/img/search_icon.png" alt="Discover">
        </li>
        </a>
        <a href=<?php echo "?action=personal_library&user_id=".$user_id?>>
        <li <?php if ($action == 'personal_library') { echo "class='selected'";}?> action='personal_library'>
            <img src="../public/img/open-book-icon.png" alt="Personal Library">
        </li>
        </a>
        <a href=<?php echo "?action=bookmarked_list&user_id=".$user_id?>>
        <li <?php if ($action == 'bookmarked_list') { echo "class='selected'";}?> onclick="">
            <img src="../public/img/bookmark_icon.png" alt="Bookmarked">
        </li>
        </a>
    </ul>
</nav>