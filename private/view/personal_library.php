        <main>
            <h1>YOUR LIBRARY</h1>
            <?php include 'search.php' ?>
            <ul>       
                <?php foreach($books as $book):?>
                <?php if($more == $book->get_id()) {
                        echo '<li style="height: auto">';
                    } else {?> <li> <?php } ?>
                    <div class="flexbox">
                        <div class="book_graphic"><p><?php echo $book->get_title()?></p></div>
                        <div class="public_info">
                            <h3><?php echo $book->title?></h3>
                            <p><?php echo $book->description?></p>
                        </div>
                        <div class="personal_info">
                            <?php if(has_presence($book->get_rating())):?>
                                <p><?php echo round($book->get_rating())?>/5</p>
                            <?php else: ?>
                                <p style="color: #85988b">2/5</p>
                            <?php endif; ?>
                        </div>
                        <form action="../private/index.php?action=personal_library&user_id=<?php echo $user->get_id()?>" method="post">
                            <label>Edit Comment:</label>
                            <input type="text" name="comment" value="<?php echo $book->get_comment(); ?>"/>
                            <label>Edit Rating:</label>
                            <input type="number" name="rate" value="<?php echo $book->get_rating(); ?>" min="1" max="5"/>
                            <input type="hidden" name="book_id" value="<?php echo $book->get_id()?>"/>
                            <input id="submit" type="submit" name="submit" value="Submit"  />
                        </form>
                    </div>
                    <a href="../private/index.php?action=personal_library&user_id=<?php echo $user_id?>&more=<?php echo $book->get_id()?>"><img class="more_button" src="../public/img/more_button.png" alt="Options"></a>
                    <a href="../private/index.php?action=personal_library&user_id=<?php echo $user_id?>&delete_library=<?php echo $book->get_id()?>"><img class="delete" src="../public/img/delete.png" alt="Delete"></a>
                   
                </li>
                <?php endforeach;?>
            </ul>

        </main>