        <main>
            <h1>YOUR LIBRARY</h1>
            <ul>
                <?php $books = find_library_of_user_id($user['id']) ?>
                
                <?php foreach($books as $book):?>
                <h2><?php echo  $book['id'].$more?></h2>
                <?php
                if($more == $book['id']) {
                    echo '<li style="height: auto">';
                } else {echo 'Didnt work'?> <li> <?php } ?>
                    <div class="flexbox">
                        <div class="book_graphic"><p><?php echo $book['title']?></p></div>
                        <div class="public_info">
                            <h3><?php echo $book['title']?></h3>
                            <p><?php echo $book['description']?></p>
                        </div>
                        <div class="personal_info">
                            <?php if(has_presence($book['rating'])):?>
                                <p><?php echo round($book['rating'])?>/5</p>
                            <?php else: ?>
                                <p style="color: #85988b">2/5</p>
                            <?php endif; ?>
                        </div>
                        <form>
                            <label>Add Comment:</label>
                            <input type="text" name="comment" value=""/>
                            <label>Add Rating:</label>
                            <input type="number" name="rating" min="1" max="5"/>
                        </form>
                    </div>
                    <a href="../private/index.php?action=personal_library&user_id=<?php echo $user_id?>&more=<?php echo $book['id']?>"><img class="more_button" src="../public/img/more_button.png" alt="Options"></a>
                    <a href="../private/index.php?action=personal_library&user_id=<?php echo $user_id?>&delete_library=<?php echo $book['id']?>"><img class="delete" src="../public/img/delete.png" alt="Delete"></a>
                   
                </li>
                <?php endforeach;?>
            </ul>

        </main>