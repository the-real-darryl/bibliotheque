<!-- Sidebar Holder -->
<nav id="sidebar">
    <div class="sidebar-header">
    <h3>Compte</h3>
    </div>

    <ul class="list-unstyled components">
        <?php
            if(!ISSET($_SESSION)) SESSION_START();
            if(ISSET($_SESSION['connected']))
            {
                echo '
                    <li>
                        <a href=\'?class=books&action=my_books\'>livre</a>
                    </li>
                    <li>
                        <a href=\'?class=review&action=my_reviews\'>review</a>
                    </li>
                    <li>
                        <a href=\'?class=demande&action=view_list\'>demande</a>
                    </li>
                    <li>
                        <a href=\'?class=account&action=display_options\'>parametre</a>
                    </li>
                    <li>
                        <a href=\'?class=account&action=logout\'>log out</a>
                    </li>';
            }
            else
            {
                echo '
                <li>
                    <a href=\'?class=account&action=login\'>log in</a>
                </li>';
            }
        ?>

    </ul>
</nav>
