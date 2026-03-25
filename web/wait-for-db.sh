#!/bin/bash
# Attendre que PostgreSQL soit prêt
host=$1
port=$2
shift 2
cmd="$@"

echo "⏳ Attente de $host:$port..."

until nc -z "$host" "$port"; do
  echo "⏳ $host non prêt, attente 2s..."
  sleep 2
done

echo "✅ $host prêt !"
exec $cmd