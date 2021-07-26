<div class="box" style="width: 1065px; float: right; background: #fff; padding: 20px; margin-bottom: 100px;">
        <h2 style="margin-top:0px">Actor List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('actor/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('actor/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('actor'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Fullname</th>
		<th>Last Update</th>
		<th>Action</th>
            </tr><?php
            foreach ($actor_data as $actor)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $actor->fullname ?></td>
			<td><?php echo $actor->last_update ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('actor/read/'.$actor->actor_id),'Read'); 
				echo ' | '; 
				echo anchor(site_url('actor/update/'.$actor->actor_id),'Update'); 
				echo ' | '; 
				echo anchor(site_url('actor/delete/'.$actor->actor_id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('actor/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('actor/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
</div>