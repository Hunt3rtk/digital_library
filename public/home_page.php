<div class='banner'>
    <a id='login' href="?action=login">LOGIN</a>
</div>
<div  class='discovery_banner'><h1>DISCOVERY</h1></div>
<ul id='discovery_ul'>
    
    <?php $books = find_all_books() ?>
    <?php foreach($books as $book):?>
    <li>

        <h3><?php echo $book->get_title()?></h3>
        <div><p><?php echo $book->get_title()?></p></div>
        <p><?php echo $book->get_description()?></p>
    </li>
    <?php endforeach;?>
</ul>