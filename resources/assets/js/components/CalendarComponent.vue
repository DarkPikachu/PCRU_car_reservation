<template>
    <b-container>
        <vue-tuicalendar
            ref="calendar"
            :options="options"
            :schedules="schedules"
            :template="template"
            @after-render-schedule="handler"
            @before-render-schedule="handler"
            @click-schedule="handler"
        >
        </vue-tuicalendar>
    </b-container>
</template>

<script>
    import { VueTuicalendar } from '@lkmadushan/vue-tuicalendar'

    import 'tui-calendar/dist/tui-calendar.min.css'

    export default {
        data() {
            return {
                schedules: [
                    {
                    id: "1",
                    calendarId: "1",
                    title: "A schedule",
                    category: "time",
                    dueDateClass: "",
                    start: "2018-05-22T22:30:00+09:00",
                    end: "2018-05-23T02:30:00+09:00"
                    },
                    {
                    id: "2",
                    calendarId: "1",
                    title: "Another schedule",
                    category: "time",
                    dueDateClass: "",
                    start: "2018-05-23T17:30:00+09:00",
                    end: "2018-05-24T17:31:00+09:00",
                    isReadOnly: true
                    }
                ],
                options: {
                    defaultView: 'month',
                    taskView: true,    // can be also ['milestone', 'task']
                    scheduleView: true,  // can be also ['allday', 'time']
                },
                template: {
                    milestone: function(schedule) {
                        return '<span style="color:red;"><i class="fa fa-flag"></i> ' + schedule.title + '</span>';
                    },
                    milestoneTitle: function() {
                        return 'Milestone';
                    },
                    task: function(schedule) {
                        return '&nbsp;&nbsp;#' + schedule.title;
                    },
                    taskTitle: function() {
                        return '<label><input type="checkbox" />Task</label>';
                    },
                    allday: function(schedule) {
                        return schedule.title + ' <i class="fa fa-refresh"></i>';
                    },
                    alldayTitle: function() {
                        return 'All Day';
                    },
                    time: function(schedule) {
                        return schedule.title + ' <i class="fa fa-refresh"></i>' + schedule.start;
                    }
                },
                month: {
                    daynames: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                    startDayOfWeek: 0,
                    narrowWeekend: true
                },
                week: {
                    daynames: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                    startDayOfWeek: 0,
                    narrowWeekend: true
                }
            }
        },
        methods: {
            handler(){

            },
            mounted() {
                this.$refs.calendar.fireMethod('clear');
                this.$refs.calendar.fireMethod('getElement');
                this.$refs.calendar.fireMethod('changeView', 'month', true);
                
                /*this.$refs.calendar.registerEvent('beforeDeleteSchedule', (event) {
                    // do stuff here
                    var a = 0;
                })*/
            }
        }
    }
</script>