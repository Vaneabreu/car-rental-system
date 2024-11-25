<style>
    /* Assign Variables */
:root {
  --bg-color: hsl(130, 20%, 80%);
  --calendar-bg-color: hsla(0, 1%, 26%, 0.281);
  --shade-color: hsla(150, 50%, 20%, 0.1);
  --text-color: hsl(130, 32%, 11%);
  --headline-color: hsl(0, 0%, 100%);
  --rule-color: hsla(0, 0%, 50%, 0);
  --primary-color: hsl(150, 50%, 50%);
  --secondary-color: hsl(129, 60%, 11%);
}

/* Setup Mixins/Helper Classes */
.clearfix:after {
  content: ".";
  display: block;
  height: 0;
  clear: both;
  visibility: hidden;
}

/* Setup Page */
*, *:before, *:after {
  box-sizing: border-box;
}

html {
  height: 100%;
}

body {
  height: 100%;
  display: flex;
  flex-direction: column;
  background: var(--bg-color);
  color: var(--text-color);
  font-family: "Montserrat", Helvetica, Arial, serif;
}

/* Calendar Styling */
.calendar {
  position: relative;
  margin: 3rem;
  overflow: hidden;
  max-width: 100%;
  flex-grow: 1;
  display: flex;
  flex-direction: column;
  border-radius: 1rem;
  background: var(--calendar-bg-color);
  box-shadow: 0.25rem 0.25rem 2rem var(--shade-color), -1rem -1rem 2rem var(--bg-color);
}

/* List styling */
.calendar ol {
  list-style: none;
  margin: 0;
  padding: 0;
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
}

.calendar li {
  width: calc(100% / 7);
  padding: 1rem;
  background: linear-gradient(-145deg, transparent, hsla(0, 0%, 0%, 0.025));
}

.calendar .days {
  flex-grow: 1;
}

.calendar .day-names {
  background: linear-gradient(70deg, var(--primary-color), var(--secondary-color));
  color: var(--headline-color);
  flex-shrink: 0;
  flex-grow: 0;
 /*  text-transform: uppercase; */
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  font-weight: bold;
  line-height: 1;
}

.calendar .date {
  margin-bottom: 0.25em;
  font-size: 0.875em;
  font-weight: bold;
}

.calendar .outside .date {
  opacity: 0.5;
}

.calendar .event {
  --dot-color: var(--primary-color);
  box-shadow: 0.25em 0.25em 1em 0 hsla(0, 0%, 0%, 0.05) inset;
  font-size: 0.75rem;
  padding: 0 0.75em;
  line-height: 2em;
  white-space: nowrap;
  overflow: hidden;
  border-radius: 1em;
  display: flex;
  align-items: center;
}

.calendar .event::before {
  content: '';
  width: 0.5em;
  height: 0.5em;
  margin-right: 0.5em;
  background: var(--dot-color);
  border-radius: 100%;
  flex-shrink: 0;
}

.calendar .event.span-2 {
  width: calc(200% + 2rem);
}

.calendar .event.begin {
  border-radius: 1em 0 0 1em;
}

.calendar .event.end {
  border-radius: 0 1em 1em 0;
}

.calendar .event.all-day {
  background: var(--shade-color);
}

.calendar .event.clear {
  visibility: hidden;
}

/* Cuadro de información al hacer hover */
.calendar .event-info {
    display: none;
    position: absolute;
    background-color: rgba(0, 0, 0, 0.705);
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    z-index: 2;
    white-space: nowrap;
    color: white;
    font-family: "Montserrat", Helvetica, Arial, serif;
}

.calendar .day-has-reservation:hover .event-info {
    display: block;
}


</style>
<div class="calendar">
    <ol class="day-names">
        <li>Domingo</li>
        <li>Lunes</li>
        <li>Martes</li>
        <li>Miércoles</li>
        <li>Jueves</li>
        <li>Viernes</li>
        <li>Sábado</li>
    </ol>
    <ol class="days">
        @php
            $mesActual = date('n');
            $añoActual = date('Y');
            $diasEnMes = cal_days_in_month(CAL_GREGORIAN, $mesActual, $añoActual);
            $primerDiaDelMes = \Carbon\Carbon::create($añoActual, $mesActual, 1);
            $primerDiaSemana = $primerDiaDelMes->dayOfWeek;

            // Crear un arreglo de días con reservas para este mes
            $diasConReserva = [];

            foreach ($reservas as $reserva) {
                $fechaReserva = \Carbon\Carbon::parse($reserva->fecha_salida);
                $mesReserva = $fechaReserva->month;
                $añoReserva = $fechaReserva->year;
                $diaReserva = $fechaReserva->day;

                if ($mesReserva == $mesActual && $añoReserva == $añoActual) {
                    $diasConReserva[] = $diaReserva;
                }
            }
        @endphp
        @for ($dia = 1 - $primerDiaSemana; $dia <= $diasEnMes; $dia++)
            <li class="day-has-reservation">
                @if ($dia > 0)
                    <div class="date">{{ $dia }}</div>
                    @if (in_array($dia, $diasConReserva))
                        @foreach ($reservas as $reserva)
                            @php
                                $fechaReserva = \Carbon\Carbon::parse($reserva->fecha_salida);
                                $mesReserva = $fechaReserva->month;
                                $añoReserva = $fechaReserva->year;
                                $diaReserva = $fechaReserva->day;
                            @endphp
                            @if ($mesReserva == $mesActual && $añoReserva == $añoActual && $diaReserva == $dia)
                                <div class="event">{{-- {{ $reserva->vehiculo }} --}}</div>
                                <div class="event-info">
                                    Vehículo: {{ $reserva->vehiculo }}<br>
                                    Fecha de reserva: {{ str_replace('00:00:00', '', $reserva->fecha_salida) }}<br>
                                    Dias de renta:  {{ $reserva->dias_renta }}
                                </div>
                            @endif
                        @endforeach
                    @endif
                @endif
            </li>
        @endfor
    </ol>
</div>








