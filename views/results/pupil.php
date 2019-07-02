<div class="text-center">
    <h1>Results</h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-3"></div>

        <div class="col-6">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col">
                        <h4><?php echo "Name: " . $this->firstName . " " . $this->lastName; ?><h4>
                    </div>

                    <div class="col text-right">
                        <h4><?php echo "Grade: " . $this->gradeData["grade_name"] ?><h4>
                    </div>
                </div>
            </div>

            <table class = "table text-center">
                <tr>
                    <th colspan="3">
                        Mid Term
                    </th>
                </tr>
                <tr>
                    <th>Subject Name</th>
                    <th>Percentage</th>
                    <th>Result Grade</th>
                </tr>
                <?php foreach($this->pupilResults as $pupilResults) {
                    foreach($pupilResults as $subjectResult) {
                        if($subjectResult["test_time"] != "mid") {
                            continue;
                        }
                        echo "
                        <td>$subjectResult[name]</td>
                        <td>$subjectResult[percentage]</td>
                        <td>$subjectResult[passGrade]</td>";
                        echo "</tr>";
                    }
                }?>
            </table>

            <table class = "table text-center">
                <tr>
                    <th colspan="3">
                        End of Term
                    </th>
                </tr>
                <tr>
                    <th>Subject Name</th>
                    <th>Percentage</th>
                    <th>Result Grade</th>
                </tr>
                <?php foreach($this->pupilResults as $pupilResults) {
                    foreach($pupilResults as $subjectResult) {
                        if($subjectResult["test_time"] != "end") {
                            continue;
                        }
                        echo "
                        <td>$subjectResult[name]</td>
                        <td>$subjectResult[percentage]</td>
                        <td>$subjectResult[passGrade]</td>";
                        echo "</tr>";
                    }
                }?>
            </table>
        </div>
        <div class="col=3"></div>
    </div>
</div>