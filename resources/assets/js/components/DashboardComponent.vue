<template>
    <b-container>
        <full-calendar ref="calendar" 
            :config="config"
            @eventClick="eventClick"
            @next="next"
            @event-selected="eventClick"
            @event-render="eventRender"
            @event-after-all-render="eventClick"
        >
        </full-calendar>
    </b-container>
</template>

<script>
    import { FullCalendar } from 'vue-full-calendar'

    export default {
        //props: ['events'],
        data() {
            return {
                config: {
                    defaultView : 'month',
                    locale: 'th',

                
                },//config
                events:[],
                //events: this.events
                /*eventSources: [
                    {
                        events(start, end, timezone, callback) {
                            console.log("event1");
                            //console.log(this.$refs.calendar.$emit('getDate'))

                            var uri = 'api/task/monthly/' + this.currentDate.format("YYYY-MM-DD")
                            console.log("call" , uri);

                            axios.get(uri,{
                                headers: {
                                    'Authorization' : 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjZiZWIxZWNiYWJiYjA4YzI2ODA2MWNkMjY2MjA3MjIwMzYyYTZjYTUwMTY2OTdjMzU1NTk2OTg2NDE4OGM2MTRhYjI5MjUzNDMyN2UxMjExIn0.eyJhdWQiOiIxIiwianRpIjoiNmJlYjFlY2JhYmJiMDhjMjY4MDYxY2QyNjYyMDcyMjAzNjJhNmNhNTAxNjY5N2MzNTU1OTY5ODY0MTg4YzYxNGFiMjkyNTM0MzI3ZTEyMTEiLCJpYXQiOjE1MzMxMTIwODYsIm5iZiI6MTUzMzExMjA4NiwiZXhwIjoxNTY0NjQ4MDg2LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Ozhi8umbCkJJaySURq2lHmCyMNfx3vmRmAi-3QUY3ZwBwfFjJo3UTjHcJpi6P6EqxnMs7KDTqNh9hfckt_N9-F8dFjPW3tYiMglzTKQqkPMJXkYROdQnfgxduoIjMfxfFp7wYQ3RC8t15ygSBtB3DhXFoHLOkR5v1EFptomlAJYKgdq1a7q0mnmph-z7uZgEsfqChns6kcFsfsM6VhEuXyjw9FcDsdJKzqp_wwSm9OFV1nleeLwAqiaLaG0WklLECuNsDizLRNuGa9Mn7SCMOgDzyuRui15gorY8KBhXrFEQ_f3-x4afEFgS8yO5IXYseOhUNyNgRIZxDDc6KmSWFG5njipRh9nwcIjBM0d_-LleoICiaCGBgFH-WXEA3dfZF0UNW8hdhPIOSZmi0Jtk8dywx3bEvxxCP1z-u3axe7EqkLFHhtBjdCD83mZayLm60xdEJifHw1KudGE-yDPR9x4QdxsRVRoRhe5QH1aX9jHugw0fnx70KTmeZA0wmjLugqupK31yR2Sws3zgYP-dXW_8cedWQ0azeBQeroXlC6ZMFV028rSqKr_adqLQtK-NblB6kgw2obm5DBl2daXPT3St3cZ8TYYwBFigJg--0ED4i7PxTObFiC5nbuNUQqbVjXGJ9_zhPbX49VQeIIEwO8SfVImkzYBnoaaQpHsQwaY',
                                    'Accept' : 'application/json'
                                }
                            }).then(response => {
                                this.results = response.data.tasks
                                //console.log('results', this.results)
                                this.results = [
                                    {
                                        title  : 'event1',
                                        start  : '2018-08-01T08:30:00',
                                        description: "I'm on holiday"
                                    },
                                    {
                                        title  : 'event2',
                                        start  : '2018-08-05',
                                        end    : '2018-08-07',
                                        description: "I'm on holiday"
                                    },
                                    {
                                        title  : 'event3',
                                        start  : '2018-08-09T12:30:00',
                                        allDay : false,
                                        description: "I'm on holiday"
                                    },
                                ]
                                callback(this.results)
                            })
                        },
                        color: 'yellow',
                        textColor: 'black',
                    },
                    {
                        events(start, end, timezone, callback) {
                            console.log("event2",end );
                            var that = this;

                            var uri = 'api/task/monthly/'+ this.currentDate.format("YYYY-MM-DD")                            
                            axios.get( uri, { 
                                headers: {
                                    'Authorization' : 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjZiZWIxZWNiYWJiYjA4YzI2ODA2MWNkMjY2MjA3MjIwMzYyYTZjYTUwMTY2OTdjMzU1NTk2OTg2NDE4OGM2MTRhYjI5MjUzNDMyN2UxMjExIn0.eyJhdWQiOiIxIiwianRpIjoiNmJlYjFlY2JhYmJiMDhjMjY4MDYxY2QyNjYyMDcyMjAzNjJhNmNhNTAxNjY5N2MzNTU1OTY5ODY0MTg4YzYxNGFiMjkyNTM0MzI3ZTEyMTEiLCJpYXQiOjE1MzMxMTIwODYsIm5iZiI6MTUzMzExMjA4NiwiZXhwIjoxNTY0NjQ4MDg2LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Ozhi8umbCkJJaySURq2lHmCyMNfx3vmRmAi-3QUY3ZwBwfFjJo3UTjHcJpi6P6EqxnMs7KDTqNh9hfckt_N9-F8dFjPW3tYiMglzTKQqkPMJXkYROdQnfgxduoIjMfxfFp7wYQ3RC8t15ygSBtB3DhXFoHLOkR5v1EFptomlAJYKgdq1a7q0mnmph-z7uZgEsfqChns6kcFsfsM6VhEuXyjw9FcDsdJKzqp_wwSm9OFV1nleeLwAqiaLaG0WklLECuNsDizLRNuGa9Mn7SCMOgDzyuRui15gorY8KBhXrFEQ_f3-x4afEFgS8yO5IXYseOhUNyNgRIZxDDc6KmSWFG5njipRh9nwcIjBM0d_-LleoICiaCGBgFH-WXEA3dfZF0UNW8hdhPIOSZmi0Jtk8dywx3bEvxxCP1z-u3axe7EqkLFHhtBjdCD83mZayLm60xdEJifHw1KudGE-yDPR9x4QdxsRVRoRhe5QH1aX9jHugw0fnx70KTmeZA0wmjLugqupK31yR2Sws3zgYP-dXW_8cedWQ0azeBQeroXlC6ZMFV028rSqKr_adqLQtK-NblB6kgw2obm5DBl2daXPT3St3cZ8TYYwBFigJg--0ED4i7PxTObFiC5nbuNUQqbVjXGJ9_zhPbX49VQeIIEwO8SfVImkzYBnoaaQpHsQwaY',
                                    'Accept' : 'application/json'
                                }
                            }).then(response => {
                                console.log("debug", this)
                                this.results = response.data.tasks

                                //this.dataAdaptor(response.data.tasks)
                                var tasks = response.data.tasks
                                var events = []
                                for(var i = 0; i < tasks.length; i++) {
                                    var tmpTitile = '';
                                    if(tasks[i].car != null)
                                        tmpTitile = tasks[i].car.name +' ทะเบียน '+ tasks[i].car.plate_number +' '+ tasks[i].car.province +' ไป ' + tasks[i].target + ' ' + tasks[i].province_code
                                    else
                                        tmpTitile = 'ไป ' + tasks[i].target + ' ' + tasks[i].province_code

                                    var obj = {
                                        id: tasks[i].id,
                                        title: tmpTitile,
                                        start: tasks[i].start_date + 'T' + tasks[i].start_time,
                                        end: tasks[i].end_date + 'T' + tasks[i].end_time,
                                        color: (tasks[i].status == '1')? '#FF9933' : (tasks[i].status == '0')? '#666666':'',
                                    }
                                    events.push(obj)
                                    console.log(obj.id);
                                }

                                this.results = events
                                callback(this.results)
                            })
                        },
                        color: '#36c',
                        textColor: 'white',
                    }
                ],//end eventSources*/
            }
        },
        components: {
            FullCalendar,
        },
        methods:{
            next() {
                console.log("next" );
                this.$refs.calendar.fireMethod('next')
            },
            eventSelected() {
                console.log("click" );
            },
            eventRender(event, element) {

                    //console.log(event);
                    console.log('get all event',this.getEvents())   

            },
            refreshEvents() {console.log("refreshEvents" );
                this.$refs.calendar.$emit('refetch-events')
                console.log("refreshEvents" );
            },
            changeMonth (start, end, current) {
                console.log("changeMonth" );
                console.log('changeMonth', start.format(), end.format(), current.format())
            },
            eventClick(event, jsEvent, pos) {
                console.log('eventClick', event, jsEvent, pos)
                this.showEvent = true
                this.eventPos = pos
                this.eventDetail = event
            },
			setShowDate(d) {
                 console.log("setShowDate" );
				this.showDate = d;
			},
            dataAdaptor: function(tasks) {
                var events = []
                for(var i = 0; i < tasks.length; i++) {
                    var obj = {
                        id: tasks[i].id,
                        title: tasks[i].car.id,
                        start: tasks[i].start_date + 'T' + tasks[i].start_time,
                        end: tasks[i].end_date + 'T' + tasks[i].end_time,
                    }
                    events.push(obj)
                    console.log(obj.id);
                }
                return events
            },
            setEvents(events){
                this.events  = events
                this.$refs.calendar.fireMethod( 'addEventSource', this.events )
            },
            getEvents(){
                return this.$refs.calendar.fireMethod('clientEvents')
            },
            monthChange(){
                console.log("rerender-events")
                this.getEvents()
            },
        },
        created () {

        },
        mounted(){
            console.log('get all event',this.getEvents())   
        }
    }
</script>

<style>
    @import '~fullcalendar/dist/fullcalendar.css';

    .fc-day-grid-event > .fc-content {
        white-space: normal;
        text-overflow: ellipsis;
    }
</style> 
