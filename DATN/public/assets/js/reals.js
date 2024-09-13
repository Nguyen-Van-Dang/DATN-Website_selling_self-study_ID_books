document.addEventListener("DOMContentLoaded", () => {
    // Xử lý các video players
    const videoPlayers = document.querySelectorAll(".videoPlayer");

    videoPlayers.forEach((videoPlayer) => {
        // Đặt thuộc tính cho video
        videoPlayer.setAttribute("autoplay", "true");
        videoPlayer.setAttribute("loop", "true");
        videoPlayer.setAttribute("playsinline", "true");

        // Play/Pause khi nhấp vào video
        videoPlayer.addEventListener("click", () => {
            if (videoPlayer.paused) {
                videoPlayer.play();
            } else {
                videoPlayer.pause();
            }
        });
    });

    // Tự động phát/tạm dừng video khi cuộn
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                const video = entry.target;
                if (entry.isIntersecting) {
                    video.play();
                } else {
                    video.pause();
                }
            });
        },
        {
            threshold: 0.5,
        }
    );

    videoPlayers.forEach((video) => observer.observe(video));

    // Xử lý phần comment
    const commentIcon = document.getElementById('commentIcon');
    const currentColumn = document.getElementById('content-column');
    const newColumn = document.getElementById('newContentColumn');
    const videoSection = document.querySelector('.video-section'); // Lấy phần tử video-section
    let isCommentSectionOpen = false;

    function toggleCommentSection() {
        if (isCommentSectionOpen) {
            currentColumn.style.display = 'block';
            newColumn.style.display = 'none';
            commentIcon.classList.remove('active'); // Loại bỏ lớp hoặc màu hoạt động
        } else {
            currentColumn.style.display = 'none';
            newColumn.style.display = 'block';
            commentIcon.classList.add('active'); // Thêm lớp hoặc màu hoạt động
        }
        isCommentSectionOpen = !isCommentSectionOpen;
    }

    commentIcon.addEventListener('click', toggleCommentSection);

    function closeCommentSection() {
        if (isCommentSectionOpen) {
            console.log("Closing comment section due to scroll or keydown."); // Dòng gỡ lỗi
            currentColumn.style.display = 'block';
            newColumn.style.display = 'none';
            commentIcon.classList.remove('active'); // Loại bỏ lớp hoặc màu hoạt động
            isCommentSectionOpen = false;
        }
    }

    if (videoSection) {
        videoSection.addEventListener('scroll', closeCommentSection);
        videoSection.addEventListener('wheel', closeCommentSection);
    }

    window.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowDown') {
            closeCommentSection();
        }
    });

    window.addEventListener('keyup', (e) => {
        if (e.key === 'ArrowDown') {
            closeCommentSection();
        }
    });

    // Xử lý nút thích
    const buttonLikes = document.querySelectorAll(".like");
    buttonLikes.forEach((like) => {
        like.addEventListener("click", () => {
            like.classList.toggle("love");
        });
    });
});

// Hàm chuyển đổi biểu tượng
function toggleIcon() {
    var icon = document.querySelector(".icon");
    if (icon.classList.contains("bx-plus")) {
        icon.classList.replace("bx-plus", "bx-check");
    } else {
        icon.classList.replace("bx-check", "bx-plus");
    }
}
