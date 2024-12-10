<?php $__env->startSection('title', 'Danh sách khóa học'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.course.course-index', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2929068417-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        </div>
    </div>
    <script>
        function openPopup(type) {
            if (type === 'delete') {
                document.getElementById("deletedCourseModal").classList.add("is-open");
            }
            document.getElementById("overlay").style.display = "block";
        }

        function closePopup() {
            document.getElementById("deletedCourseModal").classList.remove("is-open");
            document.getElementById("overlay").style.display = "none";
        }
    </script>

    <style>
        .zoom-img {
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .zoom-img:hover {
            transform: scale(2.1);
        }

        .modal-body-scrollable {
            max-height: calc(90vh - 100px);
            overflow-y: auto;
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            visibility: hidden;
        }

        .modal-content {
            opacity: 0;
            transform: translateY(-33%);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .modal.is-open .modal-overlay {
            opacity: 1;
            visibility: visible;
        }

        .modal.is-open .modal-content {
            opacity: 1;
            transform: translateY(0);
            visibility: visible;
        }

        .modal:not(.is-open) .modal-overlay {
            opacity: 0;
            visibility: hidden;
        }

        .modal:not(.is-open) .modal-content {
            opacity: 0;
            transform: translateY(-33%);
            visibility: hidden;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 50%;
            position: relative;
            max-height: 90vh;
            overflow-y: 90vh;
            padding-right: 15px;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 15px;
            cursor: pointer;
        }

        #confirmPopup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            border-radius: 5px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DATN-Website_selling_self-study_ID_books\DATN\resources\views/admin/course/listCourse.blade.php ENDPATH**/ ?>