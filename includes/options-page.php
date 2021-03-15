		<div class="wrap">
			<div id="icon-options-general" class="icon32"><br /></div> 
			<h2><?php _e( 'Newsletters' , 'news_widget' ); ?></h2>
			<p>É preciso ter uma conta no painel da <a target="_blank" href="https://emailmarketing.locaweb.com.br">revenda do e-mail marketing</a> da Locaweb.</p> 
			<form id="news_widget-form" action="options.php" method="post">
				<?php settings_fields( 'news_widget' ); ?> 
				<h3><?php _e( 'Configuração' , 'news_widget' ); ?></h3>
				<table class="form-table">
					<tr valign="top" class="news_widget-smtp">
						<th scope="row">
							<?php _e( 'Id da conta' , 'news_widget' ); ?>
						</th>
						<td>
							<input type="text" class="regular-text" name="news_widget[id_conta]" value="<?php esc_attr_e( $this->get_option( 'id_conta' ) ); ?>" placeholder="100100" />
							<p class="description"><?php _e( 'O id da conta da revenda.', 'news_widget' ); ?></p>
						</td>
					</tr>
					<tr valign="top" class="news_widget-smtp">
						<th scope="row">
							<?php _e( 'Chave de acesso' , 'news_widget' ); ?>
						</th>
						<td>
							<input type="text" class="regular-text" name="news_widget[chave]" value="<?php esc_attr_e( $this->get_option( 'chave' ) ); ?>" placeholder="zpodieAI03amaseie387JIU38" />
							<p class="description"><?php _e( 'A chave para acesso à conta.', 'news_widget' ); ?></p>
						</td>
					</tr>   
				</table> 
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e( 'Salvar' , 'news_widget' ); ?>" /> 
				</p>
			</form>
		</div>
