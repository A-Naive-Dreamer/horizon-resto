            <section>
                <main>
                    <h2>
                        Edit Cuisine
                    </h2>
                    <?php
                        echo form_open(
                            'pages/section/update-cuisine',
                            array(
                                'method' => 'POST'
                            )
                        );
                    ?>
                    <img src="http://localhost/horizon-resto/site/uploaded/<?php echo $cuisine[0]['preview']; ?>" style="display: block; margin: 0 auto; width: 80%;" />
                    <div class="form-group">
                        <label for="name">Name: </label>
                        <br/>
                        <input type="text" class="form-control" name="name" value="<?php echo $cuisine[0]['name']; ?>" required="required" />
                    </div>
                    <div class="form-group">
                        <label for="price">Price (Rp): </label>
                        <br/>
                        <input type="number" class="form-control" value="<?php echo $cuisine[0]['price']; ?>" min="1000" max="90000" step="1000" 
                            name="price" required="required" />
                    </div>
                    <div class="form-group">
                        <label for="status">Status: </label>
                        <br/>
                        <select name="status" required="required">
                            <option value="In Stock">In Stock</option>
                            <option value="Sold Out">Sold Out</option>
                        </select>
                    </div>
                    <div class="alert-info" style="margin-top: 20px">
                        Harap periksa kembali form apabila tidak ada respon setelah Anda menekan tombol login
                    </div>
                    <input type="text" name="id" value="<?php echo $cuisine[0]['id']; ?>" style="display: none;" />
                    <input type="submit" value="Ubah" name="submit" />
                </form>
