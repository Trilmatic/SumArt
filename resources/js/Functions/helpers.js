import TomSelect from "tom-select/dist/js/tom-select.complete.min";
import flatpickr from "flatpickr";

export const handleAside = () => {
    const sidenav = document.querySelector("aside");
    if (!sidenav) return;
    const sidenav_trigger = document.querySelector("[sidenav-trigger]");
    const sidenav_close_button = document.querySelector("[sidenav-close]");
    const burger = sidenav_trigger.firstElementChild;
    const top_bread = burger.firstElementChild;
    const bottom_bread = burger.lastElementChild;

    const toggleSidenav = () => {
        const isExpanded = sidenav.getAttribute("aria-expanded") === "true";
        sidenav.setAttribute("aria-expanded", isExpanded ? "false" : "true");
        sidenav.classList.toggle("translate-x-0");
        sidenav.classList.toggle("-translate-x-full");
        sidenav.classList.toggle("ml-6");
        sidenav.classList.toggle("shadow-xl");
        top_bread.classList.toggle("-translate-x-[5px]");
        bottom_bread.classList.toggle("-translate-x-[5px]");
    };

    const closeSidenav = () => {
        sidenav_trigger.click();
    };

    sidenav_trigger.addEventListener("click", toggleSidenav);
    sidenav_close_button.addEventListener("click", closeSidenav);
    window.addEventListener("click", (e) => {
        if (!sidenav.contains(e.target) && !sidenav_trigger.contains(e.target) && sidenav.getAttribute("aria-expanded") === "true") {
            closeSidenav();
        }
    });
};

export const handleSettings = () => {
    const settingsButton = document.querySelector("[settings-button]");
    const settingsButtonClose = document.querySelector("[settings-button-close]");
    const settingsBar = document.querySelector("[settings-bar]");

    const toggleSettingsBar = () => {
        settingsBar.classList.toggle("-right-90");
        settingsBar.classList.toggle("right-0");
    };

    const closeSettingsBar = () => {
        if (settingsBar.classList.contains("right-0")) {
            toggleSettingsBar();
        }
    };

    settingsButton.addEventListener("click", toggleSettingsBar);
    settingsButtonClose.addEventListener("click", closeSettingsBar);

    window.addEventListener("click", (event) => {
        if (
            !event.target.closest("[settings-bar]") &&
            !event.target.closest("[settings-button]")
        ) {
            closeSettingsBar();
        }
    });
};

export const handleColorSchemeToggle = () => {
    const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
    const themeToggleBtn = document.getElementById('theme-toggle');
    const isDarkMode =
        localStorage.getItem('color-theme') === 'dark' ||
        (!localStorage.getItem('color-theme') && window.matchMedia('(prefers-color-scheme: dark)').matches);

    // Show the correct icon based on the current mode
    themeToggleDarkIcon.classList.toggle('hidden', !isDarkMode);
    themeToggleLightIcon.classList.toggle('hidden', isDarkMode);
    themeToggleBtn.checked = isDarkMode;

    const toggleMode = () => {
        const isCurrentlyDarkMode = document.documentElement.classList.contains('dark');

        if (isCurrentlyDarkMode) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        }

        // Show the correct icon based on the updated mode
        themeToggleDarkIcon.classList.toggle('hidden', isCurrentlyDarkMode);
        themeToggleLightIcon.classList.toggle('hidden', !isCurrentlyDarkMode);
    };

    // Toggle mode on button click
    themeToggleBtn.addEventListener('change', toggleMode);
};

export const handleHelpersToggle = () => {
    if (!('helpers-enabled' in localStorage)) return true;
    return localStorage.getItem('helpers-enabled') === "true";

}

export const formatDateTime = (date) => {
    let init = new Date(date);
    return init.toLocaleString(dateFormat, { dateStyle: 'medium', timeStyle: 'short' });
}

export const formatDate = (date) => {
    let init = new Date(date);
    return init.toLocaleDateString(dateFormat);
}

export const initDateFormat = () => {
    if (localStorage.getItem('date-format')) return localStorage.getItem('date-format');
    return navigator.language;
}

export const saveDateFormat = (value) => {
    localStorage.setItem('date-format', value);
    location.reload();
}

export const dateFormat = initDateFormat();

export const createTomSelect = (element, options, defaultValue = null) => {
    const renderItem = (data, escape) => {
        return "<div>" + escape(data[options.searchField || "name"]) + "</div>";
    };
    const tomselect = new TomSelect(element, {
        valueField: options.valueField || "value",
        searchField: options.searchField || "name",
        maxItems: options.maxItems || 1,
        options: options.options,
        render: {
            option: options.renderOption || renderItem,
            item: options.renderSelection || renderItem,
        },
        create: options.create || false
    });
    if (defaultValue) tomselect.addItem(defaultValue);
    if (options.onChange) tomselect.on("change", options.onChange);
    return tomselect;
};

export const createFlatpickr = (element, options) => {
    flatpickr(element, {
        enableTime: options.enableTime || false,
        noCalendar: options.noCalendar || false,
        dateFormat: options.dateFormat || "Y-m-d",
        time_24hr: options.time_24hr || true,
        onChange: options.onChange || null
    });
};

export const debounce = (callback, wait) => {
    var timeoutId = null;
    return (...args) => {
        window.clearTimeout(timeoutId);
        timeoutId = window.setTimeout(() => {
            callback.apply(null, args);
        }, wait);
    };
}