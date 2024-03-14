<div class='banner'>
    <a id='login' href="?action=login">LOGIN</a>
</div>
<div  class='discovery_banner'><h1>DISCOVERY</h1></div>
<ul id='discovery_ul'>
    
    <?php $books = find_all_books() ?>
    <?php foreach($books as $book):?>
    <li>

        <h3><?php echo $book['title']?></h3>
        <div><p><?php echo $book['title']?></p></div>
        <p><?php echo $book['description']?></p>
    </li>
    <?php endforeach;?>
</ul>