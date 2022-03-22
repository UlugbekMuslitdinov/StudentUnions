
	
	<form action="verify_orders.php" enctype="multipart/form-data" method="POST">
							<table id="eo_upload">
								<tbody>
									<tr>
										<td style="padding-bottom: 6px;">
											<label>
												Event Order PDF:
											</label>
										</td>
										<td style="padding-bottom: 6px;">
											<!--<input type="file" name="pdf_link" id="pdf_link" accept="application/pdf" onchange="extractFromName(this.value)" required />-->
											<input type="file" name="beo" accept="application/pdf" required />
										</td>
									</tr>
									<tr>
										<td colspan="2" style="text-align: center; padding-top: 8px; border-top: 1px solid #ebebeb;">
											<input type="submit" />
										</td>
									</tr>
									<tr>
										<td class="label" style="padding-top: 10px; color: #666; font-size: 0.7em;" colspan="2">
											<!--If you choose a file with a name like "E12345 12.34pm.pdf", the event ID and time (but not date) will be automatically filled.-->
											If the file is an event order exported from CaterEase, the next screen will allow you to verify the extracted data.
										</td>
									</tr>
								</tbody>
							</table>
						</form>
			</tbody>
		</table>
	</body>
</html>