Dear supervisor, employee <?= $from->fullName() ?> requested for sometime off, starting on 
<?= $application->getVacationStart() ?> and ending on <?= $application->getVacationEnd() ?>, stating the reason:
<br>
<?= $application->getReason() ?>

<br><br>
Click on one of the below links to approve or reject the application:
<br><br>

<a href="<?= route('applications/status/'.$application->getId().'/update') ?>?status=<?= ApplicationStatus::APPROVED ?>" 
	target="_blank" style="padding-right: 15px;">Approve
</a> 
<a href="<?= route('applications/status/'.$application->getId().'/update') ?>?status=<?= ApplicationStatus::REJECTED ?>" 
	target="_blank">Reject
</a>
