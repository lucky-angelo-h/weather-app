<template>
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
      <router-link class="navbar-brand" to="/app">
        Back
      </router-link>
    </div>
  </nav>
  <main class="py-4">
    <div class="container" v-if="weather != null">
      <h1 class="mb-5">{{ place }} | <small>{{ getReadableDay(weather.forecast[0].dt_txt) }}, {{ getReadableDate(weather.forecast[0].dt_txt) }} of {{ getReadableMonth(weather.forecast[0].dt_txt) }}</small></h1>
      <div class="row justify-content-around">
        <div v-for="forecast in weather.forecast" class="col-lg-2 col-md-6 col-sm-12 col-xs-12 mb-3">
          <div class="card">
            <div class="card-header text-muted text-center ">
             <p class="fs-5 m-0">{{ getReadableTime(forecast.dt_txt) }}</p> 
            </div>
            <div class="card-body">
              <div style="height: 150px;" class="d-md-flex justify-content-around align-items-center flex-column border-radius-5 d-none">
                <div>
                  <h1 :class="renderColor(forecast.main.temp)">{{ forecast.main.temp }}&deg;C</h1>
                </div>
                <div>
                  <small :class="renderColor(forecast.main.feels_like)">Feels like: {{ forecast.main.feels_like }}&deg;C</small>
                </div>
                <div>
                  <img src="../../images/icons/humidity.png" height="18" width="18"/><small> {{ forecast.main.humidity }}%</small>
                </div>
                <div>
                  <small class="min-txt" :class="renderColor(forecast.main.temp_min)">{{ forecast.main.temp_min }}&deg;C</small> - <small class="max-txt" :class="renderColor(forecast.main.temp_max)">{{ forecast.main.temp_max }}&deg;C</small>
                </div>
              </div>

              <div style="height: 150px;" class="d-flex justify-content-around align-items-center flex-row border-radius-5 d-md-none ">
                <div class="col-6 h-100 d-flex justify-content-around align-items-center flex-column">
                  <h1 :class="renderColor(forecast.main.temp)">{{ forecast.main.temp }}&deg;C</h1>
                </div>
                <div class="col-6 h-100 d-flex justify-content-around align-items-center flex-column">
                  <div>
                    <small :class="renderColor(forecast.main.feels_like)">Feels like: {{ forecast.main.feels_like }}&deg;C</small>
                  </div>
                  <div>
                    <img src="../../images/icons/humidity.png" height="18" width="18"/><small> {{ forecast.main.humidity }}%</small>
                  </div>
                  <div>
                    <small class="min-txt" :class="renderColor(forecast.main.temp_min)">{{ forecast.main.temp_min }}&deg;C</small> - <small class="max-txt" :class="renderColor(forecast.main.temp_max)">{{ forecast.main.temp_max }}&deg;C</small>
                  </div>
                </div>
                
              </div>
            </div>
            <div class="card-footer text-muted text-center ">
             <p class="fs-5 m-0 text-capitalize">{{ forecast.weather[0].description }}</p> 
            </div>
          </div>
          
        </div>
      </div>
      <div class="row">
        <!-- <a href="https://www.flaticon.com/free-icons/humidity" title="humidity icons">Humidity icons created by justicon - Flaticon</a> -->
      </div>
    </div>
  </main>
  
</template>

<script>
  import { initCustomFormatter } from 'vue';
import { cities } from '../utils/constants';
import { getWeather } from './../service/weather/api';
  import moment from 'moment';

  export default {
    props: ['place'],
    mounted() {
        console.log('Component mounted.')
        
        this.getForecast(this.place);
    },
    data () {
      return {
        weather: null,
        details: null
      }
    },
    methods: {
      getReadableDate(ts) {
        return moment(ts).format('Do');
      },
      getReadableMonth(ts) {
        return moment(ts).format('MMMM');
      },
      getReadableDay(ts) {
        return moment(ts).format('dddd')
      },
      getReadableTime(ts) {
        return moment(ts).format('hh:mm a')
      },
      getForecast(place) {
        let x = this;
        getWeather(place).then(function(response) {
          console.log(response);
          if(response.isSuccess) {
            x.weather = response
          }
        });
      },
      renderColor(temp) {
        if( temp < 25 ) {
          return 'cold';
        } else if(temp >= 25 && temp <= 29.99 ) {
          return 'cool';
        } else if(temp >= 30 && temp <= 34.99 ) {
          return 'warm';
        } else if(temp >= 35 ) {
          return 'hot';
        }
      }
    }
  }
</script>
