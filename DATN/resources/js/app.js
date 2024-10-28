import './bootstrap';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
require('livewire/livewire');

window.Pusher = Pusher;
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '2dd03bcdcd6ca1fda1a6',
    cluster: 'ap1',
    encrypted: true,
});