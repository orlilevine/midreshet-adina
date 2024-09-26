@extends('layouts.app')

@section('title', 'Shiur Stats')

@section('content')
    <div class="container">
        <div class="form-group">
            <label for="shiur">Select a Shiur:</label>
            <select id="shiur" class="form-control">
                <option value="">-- Select a Shiur --</option>
                @foreach($shiurim as $shiur)
                    <option value="{{ $shiur->id }}">{{ $shiur->title }}</option>
                @endforeach
            </select>
        </div>

        <div id="stats-container" style="display: none;">
            <h3>Purchases for this Shiur:</h3>
            <ul id="stats-list"></ul>
        </div>
    </div>

    <script>
        document.getElementById('shiur').addEventListener('change', function() {
            var shiurId = this.value;
            var statsContainer = document.getElementById('stats-container');
            var statsList = document.getElementById('stats-list');

            if (shiurId) {
                // Send AJAX request to get the stats for the selected Shiur
                fetch('/admin/shiur-stats/' + shiurId)
                    .then(response => response.json())
                    .then(data => {
                        statsList.innerHTML = ''; // Clear previous results

                        if (data.length > 0) {
                            data.forEach(function(stat) {
                                var li = document.createElement('li');
                                li.textContent = stat.full_name + ' - Purchased on: ' + stat.created_at;
                                statsList.appendChild(li);
                            });
                        } else {
                            var li = document.createElement('li');
                            li.textContent = 'No purchases found for this Shiur.';
                            statsList.appendChild(li);
                        }

                        statsContainer.style.display = 'block'; // Show the stats section
                    });
            } else {
                statsContainer.style.display = 'none'; // Hide the stats section if no Shiur is selected
            }
        });
    </script>
@endsection
