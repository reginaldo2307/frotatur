<x-app-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Agenda Operacional Visual</h2>
        <p class="text-gray-500 text-sm">Visualize a disponibilidade da frota e motoristas no calendário.</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div id="calendar"></div>
    </div>

    @push('styles')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    <style>
        .fc-event { cursor: pointer; border: none; padding: 2px 4px; border-radius: 4px; }
        .fc-toolbar-title { font-weight: bold; font-size: 1.25rem !important; }
        .fc-button-primary { background-color: #2563eb !important; border-color: #2563eb !important; }
        .fc-button-primary:hover { background-color: #1d4ed8 !important; border-color: #1d4ed8 !important; }
    </style>
    @endpush

    @push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/pt-br.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'pt-br',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: @json($events),
                eventClick: function(info) {
                    if (info.event.url) {
                        window.location.href = info.event.url;
                        info.jsEvent.preventDefault();
                    }
                }
            });
            calendar.render();
        });
    </script>
    @endpush
</x-app-layout>
