            <section data-ng-controller="user" data-ng-init="checkPrivelege(); ">
                <main>
                <h2>
                    Menu
                </h2>
                <?php
                    echo form_open(
                        'pages/section/order',
                        array(
                            'method' => 'POST'
                        )
                    );
                ?>
                    <?php
                        for($x = 0; $x < count($cuisine); ++$x):
                    ?>
                        <div class="form-group" style="margin-bottom: 40px; text-align: center;">
                            <img src="http://localhost/horizon-resto/site/uploaded/<?php echo $cuisine[$x]['preview']; ?>" style="display: block; height: auto; margin: 0 auto 20px; width: 80%;" />
                            <input class="plates" type="checkbox" value="<?php echo $cuisine[$x]['id']; ?>" data-ng-click="select(<?php echo $x; ?>)" />
                            <?php echo $cuisine[$x]['name']; ?>
                            <hr/>
                            Price: RP. <span class="prices"><?php echo $cuisine[$x]['price']; ?>,00</span>
                            <hr/>
                            Number:
                            <br/>
                            <input class="numbers" type="number" min="0" max="10" step="1" />
                        </div>
                    <?php
                        endfor;
                    ?>
                    <div class="form-group">
                        <label for="table_number">Table Number: </label>
                        <br/>
                        <input type="number" class="form-control" id="table-number" value="1" min="1" max="10" step="1" name="table_number" required="required" />
                    </div>
                    <div class="form-group">
                        <label for="message">Message: </label>
                        <br/>
                        <textarea class="form-control" id="message" name="message"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="reservation_date">Reservation Date: </label>
                        <br/>
                        <input type="date" class="form-control" id="reservation-date" value="2018-01-01" name="reservation_date" required="required" />
                    </div>
                    <div class="form-group">
                        <label for="reservation_time">Reservation Time: </label>
                        <br/>
                        <input type="time" class="form-control" id="reservation-time" value="12:00" name="reservation_time" required="required" />
                    </div>
                    <div class="alert-info" style="margin-top: 20px">
                        Harap periksa kembali form apabila tidak ada respon setelah Anda menekan tombol login
                    </div>
                    <input type="text" id="cuisines" name="cuisines" style="display: none;" />
                    <button type="button" data-ng-click="send()">Pesan</button>
                    <input id="send" type="submit" value="Pesan" name="submit" style="display: none;" />
                </form>
