<div class="col-md-4 col-md-offset-4">
    <p>Cost Benefit Analysis</p>
    <div>Companies under <?php echo $this->session->userdata('project_name'); ?></div><br>
    <?php foreach ($com_pro as $cp): ?>
        <div class="boxhead">
            <a href="<?php echo base_url('cost_benefit/'.$this->session->userdata('project_id').'/'.$cp['id']); ?>/" class="btn btn-inverse btn-sm"><?php echo $cp['name']; ?></a>
        </div>
    <?php endforeach ?><br>
    <div>Please select a company to go to Cost - Benefit Analysis page.</div>
</div>