            <section>
                <main>
                    <h2>
                        Add New Cuisine
                    </h2>
                    <?php
                        echo form_open(
                            'pages/section/add-new-cuisine',
                            array(
                                'method' => 'POST'
                            )
                        );
                    ?>
                    <div class="form-group">
                        <label for="name">Name: </label>
                        <br/>
                        <input type="text" class="form-control" name="name" placeholder="Type cuisine name in here..." required="required" />
                    </div>
                    <div class="form-group">
                        <label for="price">Price (Rp): </label>
                        <br/>
                        <input type="number" class="form-control" min="1000" max="90000" step="1000" name="price" required="required" />
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
                    <input type="submit" value="Tambah" name="submit" />
                </form>
