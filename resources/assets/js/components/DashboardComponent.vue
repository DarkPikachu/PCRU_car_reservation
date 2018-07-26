<template>
    <b-container>
        <full-calendar :events="events"></full-calendar>
    </b-container>
</template>

<script>
    import { FullCalendar } from 'vue-full-calendar'

    export default {
        data() {
            return {
            events: [
                {
                    title  : 'event1',
                    start  : '2010-01-01',
                },
                {
                    title  : 'event2',
                    start  : '2010-01-05',
                    end    : '2010-01-07',
                },
                {
                    title  : 'event3',
                    start  : '2010-01-09T12:30:00',
                    allDay : false,
                },
            ]
            }
        }
    }
</script>

<style>
    @import '~fullcalendar/dist/fullcalendar.css';
</style> 
