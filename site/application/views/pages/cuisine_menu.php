            <section data-ng-controller="cuisineMenu">
                <main>
                    <h2>
                        My cuisines
                    </h2>
                    <table class="hip-table hip-table-chess">
                        <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Price
                                </th>
                                <th>
                                    Status
                                </th>
                                <th colspan="2">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                for($x = 0; $x < count($cuisines); ++$x):
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $cuisines[$x]['id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $cuisines[$x]['name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $cuisines[$x]['price']; ?>
                                    </td>
                                    <td>
                                        <?php echo $cuisines[$x]['status']; ?>
                                    </td>
                                    <td>
                                        <button type="button" data-ng-click="editCuisine(<?php echo $cuisines[$x]['id']; ?>)" 
                                            style="background-color: #00ff00;">Edit</button>
                                    </td>
                                    <td>
                                        <button type="button" data-ng-click="deleteCuisine(<?php echo $cuisines[$x]['id']; ?>)" 
                                            style="background-color: #ff0000;">Hapus</button>
                                    </td>
                                </tr>
                            <?php
                                endfor;
                            ?>
                        </tbody>
                    </table>
                    <button type="button" data-ng-click="addCuisine()" style="background-color: #00fffff;">Tambah</button>
