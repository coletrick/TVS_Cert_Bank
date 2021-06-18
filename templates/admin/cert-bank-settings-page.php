<?php



?>



<div class="wrap">
		<h2>TVS Certificate Number Bank</h2>
			<br />
			<br />
			<h3>Bulk Add Certificates</h3>

			<form id="bulk-add-form" method="post" action="">
				<table id="bulk-add-table">
					<tbody>
						<tr>
							<td valign="bottom">
								<label for="cert-add-start">Enter Starting Number</label><br />
								<input type="number" id="cert-add-start" name="cert-add-start"> to
							</td>
							<td valign="bottom">
								<label for="cert-add-end">Enter Ending Number</label><br />
								<input type="number" id="cert-add-end" name="cert-add-end">
							</td>
							<td valign="bottom">
								<select name="school-name" id="school-name">
								<option value="">Select a School</option>
								<option value="is_school_CP028">CP028</option>
								<option value="is_school_CP033">CP033</option>
								<option value="is_school_CP034">CP034</option>
								<option value="is_school_CP035">CP035</option>
								<option value="is_school_CP038">CP038</option>
								<option value="is_school_CP039">CP039</option>
								<option value="is_school_CP040">CP040</option>
								<option value="is_school_CP041">CP041</option>
								<option value="is_school_CP043">CP043</option>
								<option value="is_school_CP044">CP044</option>
								<option value="is_school_CP045">CP045</option>
								<option value="is_school_CP048">CP048</option>
								<option value="is_school_CP049">CP049</option>
								<option value="is_school_CP050">CP050</option>
								<option value="is_school_CP051">CP051</option>
								<option value="is_school_CP052">CP052</option>
								<option value="is_school_CP053">CP053</option>
								<option value="is_school_CP054">CP054</option>
								<option value="is_school_CP056">CP056</option>
								<option value="is_school_CP057">CP057</option>

								<option value="is_school_CP059">CP059</option>
								<option value="is_school_CP060">CP060</option>
								<option value="is_school_CP061">CP061</option>
								<option value="is_school_CP062">CP062</option>
								<option value="is_school_CP063">CP063</option>
								<option value="is_school_CP129">CP129</option>

								</select>
							</td>
						</tr>
						<tr>
							<td valign="bottom">
							<input type="submit" name="submit" id="submit" class="button button-primary" value="Bulk Add Numbers">
							</td>
							<td><?php wp_nonce_field( 'bulk-add-nonce', 'cert-nonce' ); ?></td>
						</tr>
					</tbody>
				</table>
				<span style="color:red" id="add-error"></span><br />
				<span style="color:green" id="certs-added"></span><br />
				<span style="color:green" id="certs-avail"></span>
			</form>

            <br />
			<hr />
			<br />

			<h3>Remaining Certificates</h3>

			<form id="remaining-certs-form" method="post" action="">
				<table id="remaining-certs-table">
					<tbody>
						<tr>
							<td valign="bottom">
								<select name="remaining-school-name" id="remaining-certs-school-name">
								<option value="">Select a School</option>
								<option value="is_school_CP028">CP028</option>
								<option value="is_school_CP033">CP033</option>
								<option value="is_school_CP034">CP034</option>
								<option value="is_school_CP035">CP035</option>
								<option value="is_school_CP038">CP038</option>
								<option value="is_school_CP039">CP039</option>
								<option value="is_school_CP040">CP040</option>
								<option value="is_school_CP041">CP041</option>
								<option value="is_school_CP043">CP043</option>
								<option value="is_school_CP044">CP044</option>
								<option value="is_school_CP045">CP045</option>
								<option value="is_school_CP048">CP048</option>
								<option value="is_school_CP049">CP049</option>
								<option value="is_school_CP050">CP050</option>
								<option value="is_school_CP051">CP051</option>
								<option value="is_school_CP052">CP052</option>
								<option value="is_school_CP053">CP053</option>
								<option value="is_school_CP054">CP054</option>
								<option value="is_school_CP056">CP056</option>
								<option value="is_school_CP057">CP057</option>

								<option value="is_school_CP059">CP059</option>
								<option value="is_school_CP060">CP060</option>
								<option value="is_school_CP061">CP061</option>
								<option value="is_school_CP062">CP062</option>
								<option value="is_school_CP063">CP063</option>
								<option value="is_school_CP129">CP129</option>
								</select>
							</td>
						</tr>
						<tr>
							<td valign="bottom">
							<input type="submit" name="remaining-submit" id="remaining-submit" class="button button-primary" value="Check Remaining">
							</td>
							<td><?php wp_nonce_field( 'remaining-certs-nonce', 'remaining-nonce' ); ?></td>
						</tr>
					</tbody>
				</table>
				<span style="color:red" id="remaining-certs-error"></span>
				<span style="color:green" id="remaining-certs"></span>
			</form>

            <br />
			<hr />
			<br />

			<h3>View Certificates</h3>

			<form id="cert-display-form" method="post" action="">
				<table id="cert-display-table">
					<tbody>
						<tr>
							<td valign="bottom">
								<label for="assigned-unassigned">Select Status</label><br />
								<select name="assigned-unassigned" id="assigned-unassigned">
								<option value="">Select</option>
								<option value="assigned">Assigned Certs</option>
								<option value="unassigned">Unassigned Certs</option>
								<option value="all-certs">All Certs</option>
							</td>
							<td valign="bottom">
								<select name="search-school-name" id="search-school-name">
								<option value="">Select a School</option>
								<option value="is_school_CP028">CP028</option>
								<option value="is_school_CP033">CP033</option>
								<option value="is_school_CP034">CP034</option>
								<option value="is_school_CP035">CP035</option>
								<option value="is_school_CP038">CP038</option>
								<option value="is_school_CP039">CP039</option>
								<option value="is_school_CP040">CP040</option>
								<option value="is_school_CP041">CP041</option>
								<option value="is_school_CP043">CP043</option>
								<option value="is_school_CP044">CP044</option>
								<option value="is_school_CP045">CP045</option>
								<option value="is_school_CP048">CP048</option>
								<option value="is_school_CP049">CP049</option>
								<option value="is_school_CP050">CP050</option>
								<option value="is_school_CP051">CP051</option>
								<option value="is_school_CP052">CP052</option>
								<option value="is_school_CP053">CP053</option>
								<option value="is_school_CP054">CP054</option>
								<option value="is_school_CP056">CP056</option>
								<option value="is_school_CP057">CP057</option>

								<option value="is_school_CP059">CP059</option>
								<option value="is_school_CP060">CP060</option>
								<option value="is_school_CP061">CP061</option>
								<option value="is_school_CP062">CP062</option>
								<option value="is_school_CP063">CP063</option>
								<option value="is_school_CP129">CP129</option>
								</select>
							</td>
						</tr>
						<tr>
							<td valign="bottom">
							<input type="submit" name="search-submit" id="search-submit" class="button button-primary" value="Cert Search">
							</td>
							<td><?php wp_nonce_field( 'cert-display-nonce', 'display-nonce' ); ?></td>
						</tr>
					</tbody>
				</table>
			</form>

            <br />

            <table id="cert-numbers">
                <thead>
                    <tr>		
                        <th>School</th>
                        <th>Certificate Number</th>
                        <th>User</th>
                    <tr>
                </thead>
                <tbody>
                </tbody>
            </table>

			<br /><br />
			<hr />
			<br />

			<h3>Certificate Number Search</h3>

			<form id="cert-search-form" method="post" action="">
				<table id="cert-search-table">
					<tbody>
						<tr>
							<td valign="bottom">
								<label for="cert-num">Enter Certificate Number</label><br />
								<input type="number" id="cert-search-num" name="cert-search-num">
							</td>
							<td valign="bottom">
								<select name="cert-search-school-name" id="cert-search-school-name">
								<option value="">Select a School</option>
								<option value="is_school_CP028">CP028</option>
								<option value="is_school_CP033">CP033</option>
								<option value="is_school_CP034">CP034</option>
								<option value="is_school_CP035">CP035</option>
								<option value="is_school_CP038">CP038</option>
								<option value="is_school_CP039">CP039</option>
								<option value="is_school_CP040">CP040</option>
								<option value="is_school_CP041">CP041</option>
								<option value="is_school_CP043">CP043</option>
								<option value="is_school_CP044">CP044</option>
								<option value="is_school_CP045">CP045</option>
								<option value="is_school_CP048">CP048</option>
								<option value="is_school_CP049">CP049</option>
								<option value="is_school_CP050">CP050</option>
								<option value="is_school_CP051">CP051</option>
								<option value="is_school_CP052">CP052</option>
								<option value="is_school_CP053">CP053</option>
								<option value="is_school_CP054">CP054</option>
								<option value="is_school_CP056">CP056</option>
								<option value="is_school_CP057">CP057</option>

								<option value="is_school_CP059">CP059</option>
								<option value="is_school_CP060">CP060</option>
								<option value="is_school_CP061">CP061</option>
								<option value="is_school_CP062">CP062</option>
								<option value="is_school_CP063">CP063</option>
								<option value="is_school_CP129">CP129</option>
								</select>
							</td>
						</tr>
						<tr>
							<td valign="bottom">
							<input type="submit" name="cert-search-submit" id="cert-search-submit" class="button button-primary" value="Cert Num Search">
							</td>
							<td><?php wp_nonce_field( 'cert-search-nonce', 'search-nonce' ); ?></td>
						</tr>
					</tbody>
				</table>
				<span style="color:red" id="search-error"></span>
			</form>
			
			<br />
			<br />

			<form id="cert-delete-form" method="post" action="">
				<table id="cert-searched-numbers">
					<thead>
						<tr>		
							<th>School</th>
							<th>Certificate Number</th>
							<th>User</th> 
							<th>Remove</th> 
						<tr>
					</thead>
					<tbody>
						<tr>
							<td valign="bottom">
								<input type="submit" name="cert-delete-submit" id="cert-delete-submit" class="button button-primary" value="Cert Num Delete">
							</td>
							<td><?php wp_nonce_field( 'cert-delete-nonce', 'delete-nonce' ); ?></td>
						</tr>
					</tbody>
				</table>
				<span style="color:red" id="delete-error"></span><br />
				<span style="color:green" id="delete-success"></span>
			</form>


</div>