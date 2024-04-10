<form class='search_container' action="../private/index.php?action=<?php echo $action ?>&user_id=<?php echo $user->get_id()?>" method="post">
    <input name="search" type="text" placeholder="Search" value="">
    <button type="submit" value=""><img src="../public/img/search_icon.png"></button>
    <label>ORDER BY:</label> 
    <select name="orderby">
        <?php foreach(array_keys(get_object_vars($books[0])) as $column):?>
            <option value="<?php echo $column?>"><?php echo $column?></option>
        <?php endforeach; ?>
    </select>
    <select name="order">
        <option value="ASC">ASC</option>
        <option value="DESC">DESC</option>
    </select>
</form>
