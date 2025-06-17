document.addEventListener("DOMContentLoaded", function () {
  const modal = new bootstrap.Modal(
    document.getElementById("reservationModal")
  );
  const calendarBody = document.getElementById("calendarBody");
  const calendarMonth = document.getElementById("calendarMonth");
  const prevMonthBtn = document.getElementById("prevMonth");
  const nextMonthBtn = document.getElementById("nextMonth");
  const yearFilter = document.getElementById("yearFilter");

  const BASE_URL = "http://localhost:8080/";

  const userRole = window.location.pathname.includes("admin")
    ? "admin"
    : "user";

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

    try {
      const response = await fetch(
        `${BASE_URL}/pemesanan/getReservations?month=${month}&year=${year}&_=${new Date().getTime()}`
      );

      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }

      const data = await response.json();
      if (data.status === "success") {
        reservations = data.reservations || {};

        Object.keys(reservations).forEach((day) => {
          const numDay = parseInt(day);
          if (!isNaN(numDay) && numDay !== parseInt(day)) {
            reservations[numDay] = reservations[day];
            delete reservations[day];
          }
        });
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
    calendarBody.innerHTML = "";
    const month = currentDate.getMonth();
    const year = currentDate.getFullYear();

    calendarMonth.textContent = new Intl.DateTimeFormat("id-ID", {
      month: "long",
      year: "numeric",
    }).format(currentDate);

    const firstDayOfMonth = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    let currentDay = 1;
    let row = document.createElement("tr");

    const offset = firstDayOfMonth === 0 ? 6 : firstDayOfMonth - 1;

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

    return cell;
  }

  function showReservationDetails(day) {
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

    const tableHeader = document.getElementById("tableHeader");
    const reservationList = document.getElementById("reservationList");
    reservationList.innerHTML = "";

    if (userRole === "admin") {
      tableHeader.innerHTML = `
        <th>Nama</th>
        <th>Paket Layanan</th>
        <th>Jenis Layanan</th>
        <th>Waktu Pemotretan</th>
        <th>Lokasi Pemotretan</th>
        <th>Link Maps</th>
      `;
    } else {
      tableHeader.innerHTML = `
        <th>Nama</th>
        <th>Paket Layanan</th>
        <th>Jenis Layanan</th>
        <th>Waktu Pemotretan</th>
      `;
    }

    let dayReservations =
      reservations[day] || reservations[day.toString()] || [];
    let weddingCount = 0;

    if (dayReservations.length > 0) {
      dayReservations.forEach((res) => {
        let row;
        if (userRole === "admin") {
          row = `<tr>
            <td>${res.nama_lengkap || "-"}</td>
            <td>${res.paket || "-"}</td>
            <td>${res.jenis_layanan || "-"}</td>
            <td>${res.waktu || "-"}</td>
            <td>${res.lokasi || "-"}</td>
            <td><a href="${res.link_maps_pemotretan || "#"}" target="_blank">${
            res.link_maps_pemotretan ? "Lihat Maps" : "-"
          }</a></td>
          </tr>`;
        } else {
          row = `<tr>
            <td>${res.nama_lengkap || "-"}</td>
            <td>${res.paket || "-"}</td>
            <td>${res.jenis_layanan || "-"}</td>
            <td>${res.waktu || "-"}</td>
          </tr>`;
        }
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
      const colspan = userRole === "admin" ? 6 : 4;
      reservationList.innerHTML = `<tr><td colspan="${colspan}">Tidak ada reservasi untuk tanggal ini.</td></tr>`;
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
