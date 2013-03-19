<?php
$this->load->library('message');
$this->load->view('student/includes/header');

$search = array(
    'name' => 'query',
    'id' => 'search',
    'placeholder' => 'ie- PHP',
    'style' => 'width:550px; float:left; margin-right:10px;');

$submit_button = array(
    'name'	=> 'submit',
    'value' => 'Search',
    'type'  => 'submit'
);
?>

<section>
	<h1>View all students</h1>

    <h2>Search for a student based on name, <?php echo anchor("explore", "programming languages"); ?>, school, or major: </h2>
    <?php
    $this->load->view('student/search_form');
    if (empty($students)):
        ?>
        <h2>There are currently no students.</h2>
        <?php
    endif;
    ?>
    <div class="grid">  
	<?php 
	foreach($students as $student):
        $student->skills  = get_student_skills($student->student_id);
		$data["student"] = $student;
		$this->load->view('student/small_student_block', $data);
	endforeach;
    ?>

    </div>
        <?php
	echo $this->pagination->create_links();
	?>

</section>
			
<?php $this->load->view('includes/footer'); ?>