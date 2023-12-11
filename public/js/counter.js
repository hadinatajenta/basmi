//Menghitung sisa karakter pada judul
document.addEventListener("DOMContentLoaded", function() {
    const judulInput = document.getElementById("judul");
    const counterSpan = document.getElementById("counter");
    
    // Fungsi untuk mengupdate counter karakter saat input berubah
    judulInput.addEventListener("input", function() {
        const jumlahKarakter = judulInput.value.length;
        const maksimalKarakter = 100; // Ubah sesuai dengan batasan karakter yang Anda inginkan
        
        // Menghitung sisa karakter yang tersisa
        const sisaKarakter = maksimalKarakter - jumlahKarakter;
        
        // Memperbarui teks pada span counter
        counterSpan.textContent = "Sisa karakter: " + sisaKarakter;
        
        // Mengubah warna span menjadi merah jika sisa karakter ≤ 0
        if (sisaKarakter >= 0 ) {
            counterSpan.style.color = "green";
        } else {
            counterSpan.style.color = "red"; // Menghapus warna jika sisa karakter > 0
        }
    });
});

//menghitung sisa karakter pada deskripsi
document.addEventListener("DOMContentLoaded", function(){
    const deskripsi = document.getElementById('deskripsi');
    const counter1 = document.getElementById('counter1');

    deskripsi.addEventListener('input',function(){
        const jumlahKarakter = deskripsi.value.length;
        const maksimalKarakter = 150;

        const sisaKarakter = maksimalKarakter- jumlahKarakter;

        counter1.textContent ="Sisa karakter = " + sisaKarakter;

        if(sisaKarakter <= 0){
            counter1.style.color = "red";
        }else{
            counter1.style.color = "green"
        }
    })
})

//Menghitung sisa karakter pada keyword
document.addEventListener('DOMContentLoaded',function(){
    const keywordInput = document.getElementById('keyword');
    const sisaKeyword = document.getElementById('sisaKeyword');

    keywordInput.addEventListener("input",function(){
        const jumlahKarakter = keywordInput.value.length;
        const maksimalKarakter = 160;

        const sisaKarakter = maksimalKarakter - jumlahKarakter;

        sisaKeyword.textContent = "Sisa Karakter = " + sisaKarakter ;

        if (sisaKarakter <= 0) {
            sisaKeyword.style.color = "red";
        } else {
            sisaKeyword.style.color = "green"; // Menghapus warna teks yang sudah diatur sebelumnya
        }
    })
})

//Tombol hapus
document.addEventListener("DOMContentLoaded",function(){
    const deleteButton = document.querySelectorAll('.delete-button');

    deleteButton.forEach(button => {
        button.addEventListener('click', function(){
            if(confirm('Apakah anda yakin untuk menghapus berita ini ? Berita yang dihapus tidak dapat dikembalikan.')){
                const beritaId = this.getAttribute('data-id');
                const deleteForm = document.getElementById('delete-form');
                deleteForm.action ='/home/' + beritaId;
                deleteForm.submit();
            }
        })
    })
});

//Custom SLUG
document.addEventListener('DOMContentLoaded', function () {
    // Function to show/hide custom slug input
    function toggleCustomSlugInput() {
        const customSlugInput = document.getElementById('customSlugInput');
        const customSlugRadio = document.getElementById('customSlugRadio');
        
        // Show custom slug input if the 'Custom Slug' radio is selected
        if (customSlugRadio.checked) {
            customSlugInput.style.display = 'block';
        } else {
            customSlugInput.style.display = 'none';
        }
    }

    // Event listener for changes on the radio buttons
    document.querySelectorAll('input[name="slugOption"]').forEach(function(radio) {
        radio.addEventListener('change', toggleCustomSlugInput);
    });

    // Run on initial load
    toggleCustomSlugInput();
});