<div class="row" style="padding:1% 5%">
    <h2 class="mb-4">Complains</h2>

    <?php if (!empty($Complains)) : ?>
        <div class="table-responsive">
            <table class="table table-hover ">
                <thead class="bg-dark text-white">
                    <tr>
                        <th scope="col">Complain ID</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Complain Message</th>
                        <th scope="col">Response</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Complains as $Complain) : ?>
                        <tr>
                            <th scope="row"><?php echo $Complain['ComplainID']; ?></th>
                            <td><?php echo $Complain['Subject']; ?></td>
                            <td><?php echo $Complain['Complain']; ?></td>
                            <?php if($Complain['Response']!=NULL):?>
                            <td  style="width: 300px;"> <?php echo $Complain['Response'] ?></td>
                          <?php else: ?>
                            <td style="color:red;">No response yet.</td>
                          <?php endif; ?>
                          <td>
                                <?php echo $Complain['Status']; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="col-md-4 offset-4 text-center">
            <h1>No Complains found! </h1>
        </div>

    <?php endif; ?>
</div>