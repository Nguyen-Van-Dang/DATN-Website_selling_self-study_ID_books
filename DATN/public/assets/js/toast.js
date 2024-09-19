document.addEventListener("DOMContentLoaded", () => {
    const notifications = document.querySelector(".notifications");
    const buttons = document.querySelectorAll(".buttons .btn");

    const toastDetails = {
        timer: 5000,
        success_follow: {
            icon: 'fa-circle-check',
            text: 'Đã theo dõi',
        },
        success_save: {
            icon: 'fa-circle-check',
            text: 'Đã lưu',
        },
        success: {
            icon: 'fa-circle-check',
            text: 'Success: This is a success toast.',
        },
        error: {
            icon: 'fa-circle-xmark',
            text: 'Error: This is an error toast.',
        },
        warning: {
            icon: 'fa-triangle-exclamation',
            text: 'Warning: This is a warning toast.',
        },
        info: {
            icon: 'fa-circle-info',
            text: 'Info: This is an information toast.',
        }
    };

    const clickCounts = {
        success_follow: 0,
        success_save: 0
    };

    const removeToast = (toast) => {
        toast.classList.add("hide");
        if (toast.timeoutId) clearTimeout(toast.timeoutId); // Clearing the timeout for the toast
        setTimeout(() => toast.remove(), 500); // Removing the toast after 500ms
    };

    const createToast = (id) => {
        const { icon, text } = toastDetails[id];
        const toast = document.createElement("li"); // Creating a new 'li' element for the toast
        toast.className = `toast ${id}`; // Setting the classes for the toast
        toast.innerHTML = `<div class="column">
                            <i class="fa-solid ${icon}"></i>
                            <span>${text}</span>
                         </div>
                         <i class="fa-solid fa-xmark" onclick="removeToast(this.parentElement)" style="padding-left: 10px;"></i>`;
        notifications.appendChild(toast); // Append the toast to the notification ul
        toast.timeoutId = setTimeout(() => removeToast(toast), toastDetails.timer);
    };

    // Adding a click event listener to each button to create a toast when clicked
    buttons.forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.id;
            if (id === 'success_follow' || id === 'success_save') {
                clickCounts[id] = (clickCounts[id] || 0) + 1;
                if (clickCounts[id] % 2 === 1) { // Only show toast on odd-numbered clicks
                    createToast(id);
                }
            } else {
                createToast(id);
            }
        });
    });
});
