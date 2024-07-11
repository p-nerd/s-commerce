format:
	composer run-script format
	pnpm format

setup:
	php artisan ide-helper:generate
	php artisan ide-helper:models -N

