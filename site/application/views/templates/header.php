            <header data-ng-controller="mainController" data-ng-init="setPages()">
                <div id="backgrounds">
                    <button type="button" class="background-navs" data-ng-click="previousBackground()">&lt;</button>
                    <button type="button" class="background-navs" data-ng-click="nextBackground()">&gt;</button>
                </div>
                <div id="title">
                    <?php
                        echo $title;
                    ?>
                </div>
            </header>
