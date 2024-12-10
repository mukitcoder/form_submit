<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Assignment</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<?php
$name = '';
$age = '';
$email = '';
$role = '';
$recommendation = '';
$survey_useful = [];
$comment = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = form_validate($_POST['name'] ?? '');
    $age = is_numeric($_POST['age'] ?? null) ? form_validate($_POST['age']) : '';
    $email = form_validate($_POST['email'] ?? '');
    $role = form_validate($_POST['role'] ?? '');
    $recommendation = form_validate($_POST['customRadioInline1'] ?? '');
    $survey_useful = array_map('form_validate', $_POST['survey_useful'] ?? []);
    $comment = form_validate($_POST['comment'] ?? '');
}

function form_validate($form_field_value) {
    $form_field_value = trim($form_field_value);
    $form_field_value = stripslashes($form_field_value);
    $form_field_value = htmlspecialchars($form_field_value);
    return $form_field_value;
}
?>

<section class="overflow-hidden container">
    <div class="row g-4">
        <div class="col-md-6 col-12">
            <div class="">
                <div class="header">
                    <h1 class="text-center">Survey Form</h1>
                    <p class="text-center mb-5">
                        Thank you for taking the time to help us improve the platform.
                    </p>
                </div>
                <div class="form-wrap">	
                    <form id="survey-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label id="name-label" for="name">Name</label>
                                    <input type="text" name="name" id="name" placeholder="Enter your name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label id="email-label" for="email">Email</label>
                                    <input type="email" name="email" id="email" placeholder="Enter your email" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label id="number-label" for="number">Age <small>(optional)</small></label>
                                    <input type="number" name="age" id="number" min="10" max="99" class="form-control" placeholder="Age">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Current Role</label>
                                    <select id="dropdown" name="role" class="form-control" required>
                                        <option disabled selected value>Select</option>
                                        <option value="student">Student</option>
                                        <option value="job">Full Time Job</option>
                                        <option value="learner">Full Time Learner</option>
                                        <option value="preferNo">Prefer not to say</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Would you recommend this survey to a friend?</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline1" value="Definitely" name="customRadioInline1" class="custom-control-input" checked>
                                        <label class="custom-control-label" for="customRadioInline1">Definitely</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline2" value="Maybe" name="customRadioInline1" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadioInline2">Maybe</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline3" value="Not sure" name="customRadioInline1" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadioInline3">Not sure</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Is this survey useful?</label>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" class="custom-control-input" name="survey_useful[]" value="yes" id="yes">
                                        <label class="custom-control-label" for="yes">Yes</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" class="custom-control-input" name="survey_useful[]" value="no" id="no">
                                        <label class="custom-control-label" for="no">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Leave a Message</label>
                                    <textarea id="comments" class="form-control" name="comment" placeholder="Enter your comment here..."></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <button type="submit" id="submit" class="btn btn-primary btn-block">Submit Survey</button>
                            </div>
                        </div>
                    </form>
                </div>	
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="data">    
                <h3>Form Data</h3>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th scope="row">Name</th>
                            <td><?php echo $name; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td><?php echo $email; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Age</th>
                            <td><?php echo $age; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Role</th>
                            <td><?php echo $role; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Recommendation</th>
                            <td><?php echo $recommendation; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Survey Useful</th>
                            <td><?php echo implode(', ', $survey_useful); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Comment</th>
                            <td><?php echo $comment; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
