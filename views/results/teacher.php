<div class="text-center">
    <h1>Results</h1>
</div>

<div class="accordion">
    <?php for($i = 0; $i < count($this->gradesInfo); $i++) { ?>
    <div class="card">
        <div class="card-header" id="heading<?php echo $this->gradesInfo[$i]["grade_id"]?>">
            <h2 class="mb-0">
                <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapse<?php echo $this->gradesInfo[$i]["grade_id"]?>" aria-expanded="true" aria-controls="collapseOne">
                <?php echo $this->gradesInfo[$i]["grade_name"]; ?>
                </button>
            </h2>
        </div>

        <div id="collapse<?php echo $this->gradesInfo[$i]["grade_id"]?>" class="collapse show" aria-labelledby="heading<?php echo $this->gradesInfo[$i]["grade_id"]?>">
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Mid Term Results</th>
                        <th>End of Term Results</th>
                    </tr>
                    <?php
                    foreach($this->pupilInfo as $gradeId => $pupilsInfo) {
                        if($gradeId == $this->gradesInfo[$i]["grade_id"]) {
                            foreach($pupilsInfo as $pupilInfo) { ?>
                                <tr>
                                    <td><?php echo $pupilInfo["first_name"]; ?></td>
                                    <td><?php echo $pupilInfo["last_name"]; ?></td>
                                    <td>
                                        <div id="card">
                                            <div id="card-header">
                                                <button class="btn btn-primary" style="width: 100%" type="button" data-toggle="collapse" data-target="#CollapseResultsMid<?php echo $pupilInfo["user_id"]; ?>" aria-expanded="false" aria-controls="CollapseResultsMid<?php echo $pupilInfo["user_id"]; ?>">Show/Hide</button>
                                            </div>
                                            <div class="collapse multi-collapse" id="CollapseResultsMid<?php echo $pupilInfo["user_id"]; ?>">
                                                <div id="card-body">
                                                    <div class="list-group">
                                                        <form class="form" method="post" action="<?php echo URL ?>results/updateResults/<?php echo $pupilInfo["user_id"]?>">
                                                            <?php foreach($this->gradesSubjects[$gradeId] as $subjectInfo) { ?>
                                                                <div class='list-group-item'>
                                                                    <div class="container">
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <?php echo $subjectInfo['name']; ?>
                                                                            </div>
                                                                            <div class="col text-center">
                                                                                <?php foreach($this->pupilsResults[$pupilInfo["user_id"]] as $result) {
                                                                                    if($result["subject_id_fk"] == $subjectInfo["subject_id"] && $result["test_time"] == TEST_TYPE["mid"]) {
                                                                                        echo $result["passGrade"];
                                                                                        $resultFound = true;
                                                                                        break;
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                            <div class="col text-right">
                                                                                <input readonly id="<?php echo TEST_TYPE["mid"] . $pupilInfo["user_id"] . $subjectInfo["subject_id"]; ?>" 
                                                                                    class="form-control-plaintext text-right" 
                                                                                    style="display: inline; width: 4em"
                                                                                    type="number" 
                                                                                    value= <?php 
                                                                                    $resultFound = false;
                                                                                    foreach($this->pupilsResults[$pupilInfo["user_id"]] as $result) {
                                                                                        if($result["subject_id_fk"] == $subjectInfo["subject_id"] && $result["test_time"] == TEST_TYPE["mid"]) {
                                                                                            echo $result["percentage"];
                                                                                            $resultFound = true;
                                                                                            break;
                                                                                        }
                                                                                    }
                                                                                    if(!$resultFound)
                                                                                        echo 0;
                                                                                    ?>
                                                                                    name="<?php echo $pupilInfo["user_id"] . $subjectInfo["subject_id"]; ?>" 
                                                                                    step="0.01"
                                                                                    min="0" 
                                                                                    max="100">
                                                                                <button onClick="editMark(<?php echo "'" . TEST_TYPE["mid"] . $pupilInfo["user_id"] . $subjectInfo["subject_id"] . "'"; ?>)" class="btn btn-primary btn-sm" type="button">Edit</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                            <input type="hidden" name="testType" value="<?php echo TEST_TYPE["mid"] ?>">
                                                            <div class="text-center">
                                                                <button type="submit" class="btn btn-primary form-control">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div id="card">
                                            <div id="card-header">
                                                <button class="btn btn-primary" style="width: 100%" type="button" data-toggle="collapse" data-target="#CollapseResultsEnd<?php echo $pupilInfo["user_id"]; ?>" aria-expanded="false" aria-controls="CollapseResultsEnd<?php echo $pupilInfo["user_id"]; ?>">Show/Hide</button>
                                            </div>
                                            <div class="collapse multi-collapse" id="CollapseResultsEnd<?php echo $pupilInfo["user_id"]; ?>">
                                                <div id="card-body">
                                                    <div class="list-group">
                                                        <form class="form" method="post" action="<?php echo URL ?>results/updateResults/<?php echo $pupilInfo["user_id"]?>">
                                                            <?php foreach($this->gradesSubjects[$gradeId] as $subjectInfo) { ?>
                                                                <div class='list-group-item'>
                                                                    <div class="container">
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <?php echo $subjectInfo['name']; ?>
                                                                            </div>
                                                                            <div class="col text-center">
                                                                                <?php foreach($this->pupilsResults[$pupilInfo["user_id"]] as $result) {
                                                                                    if($result["subject_id_fk"] == $subjectInfo["subject_id"] && $result["test_time"] == TEST_TYPE["end"]) {
                                                                                        echo $result["passGrade"];
                                                                                        $resultFound = true;
                                                                                        break;
                                                                                    }
                                                                                } ?>
                                                                            </div>
                                                                            <div class="col text-right">
                                                                                <input readonly id="<?php echo TEST_TYPE["end"] . $pupilInfo["user_id"] . $subjectInfo["subject_id"]; ?>" 
                                                                                    class="form-control-plaintext text-right" 
                                                                                    style="display: inline; width: 4em" 
                                                                                    type="number" 
                                                                                    value= <?php 
                                                                                    $resultFound = false;
                                                                                    foreach($this->pupilsResults[$pupilInfo["user_id"]] as $result) {
                                                                                        if($result["subject_id_fk"] == $subjectInfo["subject_id"] && $result["test_time"] == TEST_TYPE["end"]) {
                                                                                            echo $result["percentage"];
                                                                                            $resultFound = true;
                                                                                            break;
                                                                                        }
                                                                                    }
                                                                                    if(!$resultFound)
                                                                                        echo 0;
                                                                                    ?>
                                                                                    name="<?php echo $pupilInfo["user_id"] . $subjectInfo["subject_id"]; ?>" 
                                                                                    min="0" 
                                                                                    max="100">
                                                                                <button onClick="editMark(<?php echo "'" . TEST_TYPE["end"] . $pupilInfo["user_id"] . $subjectInfo["subject_id"] . "'" ?>)" class="btn btn-primary btn-sm" type="button">Edit</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                            <input type="hidden" name="testType" value="<?php echo TEST_TYPE["end"] ?>">
                                                            <div class="text-center">
                                                                <button type="submit" class="btn btn-primary form-control">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php }
                            break;
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
