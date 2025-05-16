document.addEventListener("DOMContentLoaded", function () {
  const modal = new bootstrap.Modal(
    document.getElementById("reservationModal")
  );
  const calendarBody = document.getElementById("calendarBody");
  const calendarMonth = document.getElementById("calendarMonth");
  const prevMonthBtn = document.getElementById("prevMonth");
  const nextMonthBtn = document.getElementById("nextMonth");
  const yearFilter = document.getElementById("yearFilter");

  // Ganti dengan base URL aplikasi Anda
  const BASE_URL = "http://localhost:8080"; // Sesuaikan dengan baseURL di app/Config/App.php

  let currentDate = new Date();
  let reservations = {};

  function generateYearOptions() {
    const currentYear = new Date().getFullYear();
    for (let i = currentYear - 1; i <= currentYear + 3; i++) {
      const option = document.createElement("option");
      option.value = i;
      option.textContent = i;
      yearFilter.appendChild(option);
    }
    yearFilter.value = currentYear;
  }

  async function fetchReservations() {
    const month = currentDate.getMonth() + 1;
    const year = currentDate.getFullYear();
    console.log(`Mengambil reservasi untuk bulan ${month}, tahun ${year}`);

    try {
      const response = await fetch(
        `${BASE_URL}/pemesanan/getReservations?month=${month}&year=${year}&_=${new Date().getTime()}`
      );

      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }

      const data = await response.json();
      console.log("Respons dari backend:", data);

      if (data.status === "success") {
        reservations = data.reservations || {};
        console.log("Reservasi yang diterima:", reservations);

        // Konversi kunci ke integer
        Object.keys(reservations).forEach((day) => {
          const numDay = parseInt(day);
          if (!isNaN(numDay) && numDay !== parseInt(day)) {
            reservations[numDay] = reservations[day];
            delete reservations[day];
          }
        });

        if (Object.keys(reservations).length === 0) {
          console.warn("Tidak ada reservasi ditemukan untuk bulan ini.");
        }
      } else {
        console.error("Gagal memuat reservasi:", data.message);
        reservations = {};
        alert("Gagal memuat data reservasi: " + data.message);
      }
    } catch (error) {
      console.error("Error saat mengambil reservasi:", error);
      reservations = {};
      alert(
        "Terjadi kesalahan saat mengambil data reservasi. Silakan coba lagi."
      );
    }

    renderCalendar();
  }

  function renderCalendar() {
    console.log("Merender kalender untuk:", currentDate);
    calendarBody.innerHTML = "";
    const month = currentDate.getMonth();
    const year = currentDate.getFullYear();

    calendarMonth.textContent = new Intl.DateTimeFormat("id-ID", {
      month: "long",
      year: "numeric",
    }).format(currentDate);

    const firstDayOfMonth = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    console.log(
      `Hari pertama bulan: ${firstDayOfMonth}, Jumlah hari: ${daysInMonth}`
    );

    let currentDay = 1;
    let row = document.createElement("tr");

    const offset = firstDayOfMonth === 0 ? 6 : firstDayOfMonth - 1;
    console.log(`Offset: ${offset}`);

    for (let i = 0; i < offset; i++) {
      const cell = document.createElement("td");
      cell.classList.add("empty-day");
      row.appendChild(cell);
    }

    while (currentDay <= daysInMonth) {
      if ((currentDay + offset - 1) % 7 === 0 && currentDay > 1) {
        calendarBody.appendChild(row);
        row = document.createElement("tr");
      }

      row.appendChild(createCalendarCell(currentDay));
      currentDay++;
    }

    const remainingCells = 7 - (row.childNodes.length % 7);
    if (remainingCells < 7) {
      for (let i = 0; i < remainingCells; i++) {
        const cell = document.createElement("td");
        cell.classList.add("empty-day");
        row.appendChild(cell);
      }
    }

    calendarBody.appendChild(row);
  }

  function createCalendarCell(day) {
    const cell = document.createElement("td");
    const dayContainer = document.createElement("div");
    dayContainer.className = "day-container";

    const dayNumber = document.createElement("div");
    dayNumber.className = "day-number";
    dayNumber.textContent = day;
    dayContainer.appendChild(dayNumber);

    const indicator = document.createElement("div");
    indicator.className = "reservation-indicator";

    const reservationData =
      reservations[day.toString()] || reservations[day] || [];
    const hasReservations = reservationData.length > 0;

    let weddingCount = 0;
    if (hasReservations) {
      reservationData.forEach((res) => {
        if (res.jenis_layanan === "Wedding") {
          weddingCount++;
        }
      });
    }

    if (hasReservations) {
      indicator.innerHTML = `<span class="badge bg-danger">${reservationData.length}</span>`;
      if (weddingCount > 0) {
        indicator.innerHTML += ` <span class="badge bg-warning">W:${weddingCount}/3</span>`;
      }
      cell.classList.add("reserved");
    } else {
      cell.classList.add("available");
    }

    dayContainer.appendChild(indicator);
    cell.appendChild(dayContainer);

    cell.setAttribute("data-day", day);
    cell.addEventListener("click", function () {
      showReservationDetails(day);
    });

    console.log(
      `Hari ${day}:`,
      hasReservations ? reservationData : "Tidak ada reservasi"
    );

    return cell;
  }

  function showReservationDetails(day) {
    console.log(`Menampilkan detail reservasi untuk hari ${day}`);
    const reservationDate = new Date(
      currentDate.getFullYear(),
      currentDate.getMonth(),
      day
    );

    document.getElementById("reservationDate").textContent =
      reservationDate.toLocaleDateString("id-ID", {
        weekday: "long",
        day: "numeric",
        month: "long",
        year: "numeric",
      });

    const reservationList = document.getElementById("reservationList");
    reservationList.innerHTML = "";

    let dayReservations =
      reservations[day] || reservations[day.toString()] || [];
    console.log("Data reservasi untuk modal:", dayReservations);

    let weddingCount = 0;
    if (dayReservations.length > 0) {
      dayReservations.forEach((res) => {
        let row = `<tr>
              <td>${res.nama || "-"}</td>
              <td>${res.paket || "-"}</td>
              <td>${res.waktu || "-"}</td>
              <td>${res.lokasi || "-"}</td>
            </tr>`;
        reservationList.innerHTML += row;

        if (res.jenis_layanan === "Wedding") {
          weddingCount++;
        }
      });

      document.getElementById("bookedCount").textContent =
        dayReservations.length;
      document.getElementById("remainingQuota").textContent =
        weddingCount >= 3 ? 0 : 3 - weddingCount;
    } else {
      reservationList.innerHTML =
        '<tr><td colspan="4">Tidak ada reservasi untuk tanggal ini.</td></tr>';
      document.getElementById("bookedCount").textContent = 0;
      document.getElementById("remainingQuota").textContent = 3;
    }

    modal.show();
  }

  prevMonthBtn.addEventListener("click", function () {
    currentDate.setMonth(currentDate.getMonth() - 1);
    fetchReservations();
  });

  nextMonthBtn.addEventListener("click", function () {
    currentDate.setMonth(currentDate.getMonth() + 1);
    fetchReservations();
  });

  yearFilter.addEventListener("change", function () {
    currentDate.setFullYear(parseInt(this.value));
    fetchReservations();
  });

  generateYearOptions();
  fetchReservations();
});
