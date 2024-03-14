        <main>
            <h1>DISCOVER</h1>
            <ul>
                <?php $books = find_all_books() ?>
                <?php foreach($books as $book):?>
                    <?php $rating = find_avg_book_rating($book['id']); ?>
                    <li>
                        <div class="flexbox">
                            <div class="book_graphic"><p><?php echo $book['title']?></p></div>
                            <div class="public_info">
                                <h3><?php echo $book['title']?></h3>
                                <p><?php echo $book['description']?></p>
                            </div>
                            <div class="personal_info">
                                <?php if (!is_null($rating)) { ?>
                                    <p><?php echo round(mysqli_fetch_array($rating)[0]) ?>/5</p>
                                <?php } ?>
                            </div>
                        </div>
                        <a href="../private/index.php?action=personal_library&user_id=<?php echo $user_id?>&add=<?php echo $book['id']?>"><img class="add" src="../public/img/add.png" alt="Add"></a>
                    </li>
                <?php endforeach;?>
            </ul>
        </main>