<?php
include ('include/db.php');
include ('include/header.php');
$query = "SELECT `Name`,`Rarity`  FROM `xref-Dino_info`";
$result = mysqli_query($con, $query);
?>
<div class="container-fluid">
    <div class="container">
        <div class="calendar-main pt-5">
            <form  id="form-fm" class="calendar-fm" metho="post" action="">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group ">
                            <label for="calFormControlSelect1">Dinosaur</label>
                            <select class="form-control" id="calFormControlSelect1" name="dinasaur">
                                <option value="">Select Dinosaur</option>    
                                <?php foreach ($result as $data) {
                                    ?>
                                    <option value=<?php echo $data['Rarity']; ?>  data-id="<?php echo $data['Name']; ?>"><?php echo $data['Name']; ?></option>    
                                <?php } ?>
                            </select>
                            <input type="hidden" id="dia-hidden" name="dinasaur_name" value=""> 
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group ">
                            <label for="currentFormControlInput1">Current</label>
                            <input type="text" class="form-control" name="current"  id="currentFormControlInput1" placeholder="Enter level" value="">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group ">
                            <label for="desiredFormControlTextarea1">Desired</label>
                            <input type="text" class="form-control"  name ="desired" id="desiredFormControlInput1" placeholder="Enter level" value="">
                        </div>
                        <div class="alert alert-danger dna-error" style="display:none">
                            <strong>Danger!</strong> desired_level > current level 
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="current-dna  text-white"> 
            <div class="row">
                <div class="col-4">
                    <div class="dinasaur-image">

                    </div>
                </div>
                <div class="col-4">
                    <label>DNA Used</label>
                    <div class="c-dna">
                        <h3>0</h3>
                    </div>
                </div>
                <div class="col-4">
                    <label>Coins spent</label>
                    <div class="coin-spent">
                        <h3>0</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="required-dna  text-white"> 
            <div class="row">
                <div class="col-4">
                    <label>Exp Points Gained</label>
                    <div class="exp_point">
                        <h3>0</h3>
                    </div>
                </div>
                <div class="col-4">
                    <label>DNA Required</label>
                    <div class="r-dna">
                        <h3>0</h3>
                    </div>
                </div>
                <div class="col-4">
                    <label>Coins Required</label>
                    <div class="coin-required">
                        <h3>0</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="note-dna  text-white"> 
            <div class="row">
                <div class="col-12">
                    <p>Note: Does not incorporate fusion costs</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="calendar-main-table"></div>
<?php include ('include/footer.php'); ?>