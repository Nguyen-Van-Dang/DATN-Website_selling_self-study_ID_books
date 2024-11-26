<?php $__env->startComponent('mail::message'); ?>
# Bạn có một thông báo mới !!!

Tên: <?php echo e($contactData['name']); ?>  
Email: <?php echo e($contactData['email']); ?>  
Nội dung: <?php echo e($contactData['message']); ?>


Thanks,<br>

<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?><?php /**PATH D:\DATN-Website_selling_self-study_ID_books\DATN\resources\views/mail/contact-us-mail.blade.php ENDPATH**/ ?>