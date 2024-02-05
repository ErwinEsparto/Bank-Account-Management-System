const ham_btn = document.querySelector(".hamburger");
const profnav_btn = document.querySelector(".profile-nav");

ham_btn.addEventListener('click', function(){
    ham_btn.classList.toggle('is-active');
    profnav_btn.classList.toggle('is-active');
});

// document.getElementsByClassName('amountOne').addEventListener('keydown', function(e) {
//     e.preventDefault();
//     if (e.key === 'ArrowUp' && this.value < parseInt(this.max)) {
//         this.value = parseInt(this.value) + 1;
//     } else if (e.key === 'ArrowDown' && this.value > parseInt(this.min)) {
//         this.value = parseInt(this.value) - 1;
//     }
// });

// document.getElementsByClassName('amountTwo').addEventListener('keydown', function(e) {
//     e.preventDefault();
//     if (e.key === 'ArrowUp' && this.value < parseInt(this.max)) {
//         this.value = parseInt(this.value) + 1;
//     } else if (e.key === 'ArrowDown' && this.value > parseInt(this.min)) {
//         this.value = parseInt(this.value) - 1;
//     }
// });