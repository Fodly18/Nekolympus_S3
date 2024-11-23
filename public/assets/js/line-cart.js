
const ctx = document.getElementById('lineChart').getContext('2d');

    
const data = {
    labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'], // Days of the week
    datasets: [{
        label: 'Pengunjung',
        data: [120, 150, 180, 220, 200, 250, 300], // Dummy data for visitors
        borderColor: 'rgba(75, 192, 192, 1)', // Line color
        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Area under the line
        borderWidth: 2,
        tension: 0.3 // Makes the line smooth
    }]
};


const config = {
    type: 'line',
    data: data,
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top'
            },
            tooltip: {
                enabled: true
            }
        },
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Hari'
                }
            },
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Jumlah Pengunjung'
                }
            }
        }
    }
};


new Chart(ctx, config);
