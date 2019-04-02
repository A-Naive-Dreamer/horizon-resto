            <section>
                <main>
                    <h2>
                        Report
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
                                    Table Number
                                </th>
                                <th>
                                    Message
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Fee
                                </th>
                                <th>
                                    Reservation Date
                                </th>
                                <th>
                                    Reservation Time
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                for($x = 0; $x < count($orders); ++$x):
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $orders[$x]['id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $orders[$x]['name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $orders[$x]['table_number']; ?>
                                    </td>
                                    <td>
                                        <?php echo $orders[$x]['message']; ?>
                                    </td>
                                    <td>
                                        <?php echo $orders[$x]['status']; ?>
                                    </td>
                                    <td>
                                        <?php echo $orders[$x]['fee']; ?>
                                    </td>
                                    <td>
                                        <?php echo $orders[$x]['reservation_date']; ?>
                                    </td>
                                    <td>
                                        <?php echo $orders[$x]['reservation_time']; ?>
                                    </td>
                                </tr>
                            <?php
                                endfor;
                            ?>
                        </tbody>
                    </table>
