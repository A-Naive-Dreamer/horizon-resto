            <section>
                <main>
                <?php
                    echo form_open(
                        'pages/section/check',
                        array(
                            'method' => 'POST'
                        )
                    );
                ?>
                    <div id="people">
                        <img src="http://localhost/horizon-resto/media/pictures/people.png" height="150" width="150" />
                    </div>
                    <div class="form-group">
                        <label for="privelege">Privelege: </label>
                        <br/>
                        <select class="form-control" id="privelege" name="privelege">
                            <option value="guest">
                                Guest
                            </option>
                            <option value="waiter">
                                Waiter
                            </option>
                            <option value="cashier">
                                Cashier
                            </option>
                            <option value="owner">
                                Owner
                            </option>
                            <option value="administrator">
                                Administrator
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="username">Username: </label>
                        <input type="text"  pattern="^[a-z]+(-?[a-z]+)*$" class="form-control" id="username" name="username" maxlength="50" placeholder="a-naive-dreamer" required="required" />
                    </div>
                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="text" class="form-control" id="email" name="e_mail" maxlength="50" placeholder="anaivedreamer@gmail.com" required="required" />
                    </div>
                    <div class="form-group">
                        <label for="Password">Password: </label>
                        <input type="password" class="form-control" id="password" name="password" maxlength="50" placeholder="Password" required="required" />
                    </div>
                    <div class="alert-info">
                        Harap periksa kembali form apabila tidak ada respon setelah Anda menekan tombol login
                    </div>
                    <input type="submit" value="Log in" name="log_in" />
                </form>
