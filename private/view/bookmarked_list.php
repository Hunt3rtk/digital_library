        <main>
            <h1>BOOKMARKED</h1>
            <?php include 'search.php' ?>
            <ul>
                <?php foreach($books as $book):?>
                    <?php $rating = find_avg_book_rating($book->get_id()); ?>
                <li>
                    <div class="flexbox">
                        <div class="book_graphic"><p><?php echo $book->get_title()?></div>
                        <div class="public_info">
                            <h3><?php echo $book->get_title()?></h3>
                            <p><?php echo $book->get_description()?></p>
                        </div>
                        <div class="personal_info">
                            <?php if (!is_null($rating)) { ?>
                                <p><?php echo round(mysqli_fetch_array($rating)[0]) ?>/5</p>
                            <?php } ?>
                        </div>
                    </div>
                    <a href="../private/index.php?action=bookmarked_list&user_id=<?php echo $user_id?>&delete_bookmark=<?php echo $book->get_id()?>"><img class="delete" src="../public/img/delete.png" alt="Delete"></a>
                </li>
                <?php endforeach;?>
            </ul>
        </main>